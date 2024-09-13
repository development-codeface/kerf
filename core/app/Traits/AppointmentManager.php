<?php

namespace App\Traits;

use App\Constants\Status;
use App\Models\Appointment;
use App\Models\AssistantDoctorTrack;
use App\Models\Doctor;
use Carbon\Carbon;
use App\Models\GatewayCurrency;
use Illuminate\Http\Request;

/**
 * All Common functionalities to make an appointment
 */
trait AppointmentManager
{
    public $userType;


    public function form()
    {
        $pageTitle = 'Make Appointment';
        $doctors   = Doctor::active()->orderBy('name')->get();
        return view($this->userType . '.appointment.form', compact('pageTitle', 'doctors'));
    }

    public function details(Request $request)
    {
        /**;
         * If making appointment via doctor guard then do not check doctor! use else!
         */
        if ($this->userType == 'doctor') {
            $doctor = Doctor::findOrFail(auth()->guard('doctor')->id());
        } else {
            $request->validate([
                'doctor_id' => 'required|numeric|gt:0',
            ]);
            $doctor = Doctor::findOrFail($request->doctor_id);
        }


        if (!$doctor->serial_or_slot) {
            $notify[] = ['error', 'No available schedule for this doctor!'];
            return back()->withNotify($notify);
        }

        $availableDate = [];
        $date          = Carbon::now();
        for ($i = 0; $i < $doctor->serial_day; $i++) {
            array_push($availableDate, date('Y-m-d', strtotime($date)));
            $date->addDays(1);
        }
        $pageTitle = 'Make Appointment';
        return view($this->userType . '.appointment.booking', compact('doctor', 'pageTitle', 'availableDate'));
    }

    public function availability(Request $request)
    {

        $collection = Appointment::hasDoctor()->where('doctor_id', $request->doctor_id)->where('try', Status::YES)->where('is_delete', Status::NO)->whereDate('booking_date', Carbon::parse($request->date))->get();

        $data = collect([]);
        foreach ($collection as  $value) {
            $data->push($value->time_serial);
        }
        return response()->json(@$data);
    }

    public function store(Request $request, $id)
    {
        $this->validation($request);

        // echo $request->re_visit ?  $request->re_visit: 'not selected' ;
        // exit;
        $doctor = Doctor::active()->find($id);

        if (!$doctor) {
            $notify[] = ['error', 'The doctor isn\'t available for the appointment'];
            return back()->withNotify($notify);
        }

        if (!$doctor->serial_or_slot) {
            $notify[] = ['error', 'No available schedule for this doctor'];
            return back()->withNotify($notify);
        }

        $timeSerialCheck = $doctor->whereJsonContains('serial_or_slot', $request->time_serial)->exists();

        if (!$timeSerialCheck) {
            $notify[] = ['error', 'Invalid! Something went wrong'];
            return back()->withNotify($notify);
        }

        $existed = Appointment::where('doctor_id', $doctor->id)->where('booking_date', $request->booking_date)->where('time_serial', $request->time_serial)->where('try', Status::YES)->where('is_delete', Status::NO)->exists();

        if ($existed) {
            $notify[] = ['error', 'This time or serial is already booked. Please try another or time or serial'];
            return back()->withNotify($notify);
        }

        if ($this->userType == 'assistant') {
            $doctorCheck = AssistantDoctorTrack::where('assistant_id', auth()->guard('assistant')->id())->where('doctor_id', $doctor->id)->first();

            if (!$doctorCheck) {
                $notify[] = ['error', 'You don\'t have permission to operate this action'];
                return back()->withNotify($notify);
            }
        }

        /**
         *Site: Gateway payment is via online. payment_system is cash==2 and  gateways==1;
        **/

        $gateways = ($request->payment_system == 1) ? Status::YES : Status::NO;
        $general  = gs();
        $mobile   =  $general->country_code . $request->mobile;

        //save
        $appointment               = new Appointment();
        $appointment->booking_date = Carbon::parse($request->booking_date)->format('Y-m-d');
        $appointment->time_serial  = $request->time_serial;
        $appointment->name         = $request->name;
        $appointment->email        = $request->email;
        $appointment->mobile       = $mobile;
        $appointment->age          = $request->age;
        $appointment->doctor_id    = $doctor->id;
        $appointment->disease      = $request->disease;
        $appointment->try          =  $gateways ? Status::NO : Status::YES;
        $appointment->trx          =  $gateways ?  getTrx() : NULL;

        if ($this->userType == 'admin') {
            $appointment->added_admin_id = 1;
        } elseif ($this->userType == 'doctor') {
            $appointment->added_doctor_id = auth()->guard('doctor')->id();
        } elseif ($this->userType == 'staff') {
            $appointment->added_staff_id = auth()->guard('staff')->id();
        } elseif ($this->userType == 'assistant') {
            $appointment->added_assistant_id = auth()->guard('assistant')->id();
        } else {
            $appointment->site = Status::YES;
        }

        if ($gateways) {
            $appointment->try  = Status::NO;
        } else {
            $appointment->try  = Status::YES;
        }

        $appointment->save();

        if ($gateways) {
            $appointment->payment_status = Status::APPOINTMENT_PENDING_PAYMENT;
            $appointment->save();

            $pageTitle = "Appointment Payment Method";
            $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', Status::ENABLE);
            })->with('method')->orderby('method_code')->get();
            $fees     = $request->re_visit ?  $doctor->revisit_fees: $doctor->fees ;
            // $fees     = $doctor->fees;
            $doctorId = $doctor->id;
            $trx      = $appointment->trx;
            $email    = $request->email;

            return view($this->activeTemplate . 'user.payment.deposit', compact('pageTitle', 'fees', 'doctorId', 'trx', 'email', 'gatewayCurrency'));
        }

        notify($this->notifyUser($appointment), 'APPOINTMENT_CONFIRMATION', [
            'booking_date' => $appointment->booking_date,
            'time_serial'  => $appointment->time_serial,
            'doctor_name'  => $doctor->name,
            'doctor_fees'  => '' . $doctor->fees . ' ' . $general->cur_text . '',
        ]);

        $notify[] = ['success', 'New Appointment make successfully'];
        return back()->withNotify($notify);
    }

    protected function validation($request)
    {
        $request->validate(
            [
                'name'           => 'required|max:40',
                'booking_date'   => 'required|date|after_or_equal:today',
                'time_serial'    => 'required',
                'email'          => 'required|email',
                'mobile'         => 'required|max:40',
                'age'            => 'required|integer|gt:0',
                'payment_system' => 'nullable|in:1,2',
            ],
            [
                'time_serial.required' => 'You did not select any time or Serial',
            ]
        );
    }

    public function done($id)
    {
        $appointment =  Appointment::findOrFail($id);

        if ($appointment->is_complete == Status::APPOINTMENT_INCOMPLETE && $appointment->payment_status != Status::APPOINTMENT_PAID_PAYMENT) {
            $appointment->is_complete = Status::APPOINTMENT_COMPLETE;

            if ($appointment->payment_status == Status::APPOINTMENT_CASH_PAYMENT) {
                $doctor = Doctor::findOrFail($appointment->doctor->id);
                $doctor->balance += $doctor->fees;
                $doctor->save();
                $appointment->payment_status = Status::APPOINTMENT_PAID_PAYMENT;
            }

            $appointment->save();
            $notify[] = ['success', 'Appointed service is done successfully'];
            return back()->withNotify($notify);

        } else {
            $notify[] = ['error', 'Something is wrong!'];
            return back()->withNotify($notify);
        }
    }

    public function remove($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->is_delete || $appointment->payment_status) {
            $notify[] = ['error', 'Appointment trashed operation is invalid'];
            return back()->withNotify($notify);
        }

        $appointment->is_delete = Status::YES;

        if ($this->userType == 'admin') {
            $appointment->delete_by_admin = 1;
        } elseif ($this->userType == 'staff') {
            $appointment->delete_by_staff = auth()->guard('staff')->id();
        } elseif ($this->userType == 'doctor') {
            $appointment->delete_by_doctor = auth()->guard('doctor')->id();
        } else {
            $appointment->delete_by_assistant = auth()->guard('assistant')->id();
        }

        $appointment->save();

        notify( $this->notifyUser($appointment), 'APPOINTMENT_REJECTION', [
            'booking_date' => $appointment->booking_date,
            'time_serial'  => $appointment->time_serial,
            'doctor_name'  => $appointment->doctor->name
        ]);

        $notify[] = ['success', 'Appointment service is trashed successfully'];
        return back()->withNotify($notify);
    }

    protected  function notifyUser($appointment)
    {
        $user = [
            'name'     => $appointment->name,
            'username' => $appointment->email,
            'fullname' => $appointment->name,
            'email'    => $appointment->email,
            'mobile'   => $appointment->mobile,
        ];
        return $user;
    }

    protected function detectUserType($appointments)
    {
        if ($this->userType == 'admin' || $this->userType == 'staff') {
            $appointments  = $appointments->hasDoctor();
        } else {
            $appointments->where('doctor_id', auth()->guard('doctor')->id());
        }

        if ($this->userType == 'staff') {
            $appointments  = $appointments->where('added_staff_id', auth()->guard('staff')->id());
        }

        $appointments = $appointments->searchable(['name', 'email', 'disease'])->orderBy('id', 'DESC')->paginate(getPaginate());

        return $appointments;
    }

    public function new()
    {
        $pageTitle    = 'All New Appointments';
        $appointments = Appointment::newAppointment()->with('staff', 'doctor', 'assistant');
        $appointments = $this->detectUserType($appointments);

        return view($this->userType . '.appointment.index', compact('pageTitle', 'appointments'));
    }

    public function doneService()
    {
        $pageTitle    = 'Service Done Appointments';
        $appointments = Appointment::CompleteAppointment()->with('staff', 'doctor', 'assistant');
        $appointments = $this->detectUserType($appointments);

        return view($this->userType . '.appointment.index', compact('pageTitle', 'appointments'));
    }

    public function serviceTrashed()
    {
        $pageTitle    = 'Trashed Appointments';
        $appointments = Appointment::where('is_delete', Status::YES)->with('deletedByStaff', 'deletedByDoctor', 'deletedByAssistant', 'doctor', 'staff', 'assistant');
        $appointments = $this->detectUserType($appointments);

        return view($this->userType . '.appointment.index', compact('pageTitle', 'appointments'));
    }
}
