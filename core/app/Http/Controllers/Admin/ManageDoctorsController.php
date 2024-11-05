<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Deposit;
use App\Models\Doctor;
use App\Models\Location;
use App\Models\Department;
use App\Models\DoctorLogin;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManageDoctorsController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Doctors';
        $doctors = $this->commonQuery()->paginate(getPaginate());
        return view('admin.doctor.index', compact('pageTitle', 'doctors'));
    }

    public function active($status)
    {
        $pageTitle = 'Active Doctors';
        $doctors = $this->commonQuery()->where('status', Status::ACTIVE)->paginate(getPaginate());
        return view('admin.doctor.index', compact('pageTitle', 'doctors'));
    }

    public function inactive($status)
    {
        $pageTitle = 'Inactive Doctors';
        $doctors = $this->commonQuery()->where('status', Status::INACTIVE)->paginate(getPaginate());
        return view('admin.doctor.index', compact('pageTitle', 'doctors'));
    }

    protected function commonQuery()
    {
        return Doctor::orderBy('id', 'DESC')->searchable(['name', 'mobile', 'email', 'department:name', 'location:name'])->with('department', 'location')->filter(['status']);
    }

    public function status($id)
    {
        return Doctor::changeStatus($id);
    }

    public function featured($id)
    {
        return Doctor::changeStatus($id, 'featured');
    }

    public function form()
    {
        $pageTitle   = 'Add New Doctor';
        $departments = Department::orderBy('name')->get();
        $locations   = Location::orderBy('name')->get();
        return view('admin.doctor.form', compact('pageTitle', 'departments', 'locations'));
    }

    public function store(Request $request, $id = 0)
    {
        $this->validation($request, $id);

        if ($id) {
            $doctor         = Doctor::findOrFail($id);
            $notification       = 'Doctor updated successfully';
        } else {
            $doctor         = new Doctor();
            $notification       = 'Doctor added successfully';
        }

        $this->doctorSave($doctor, $request);

        if (!$id) {
            $general = gs();
            notify($doctor, 'PEOPLE_CREDENTIAL', [
                'site_name' => $general->site_name,
                'name'      => $doctor->name,
                'username'  => $doctor->username,
                'password'  => decrypt($doctor->password),
                'guard'     => route('login'),
            ]);
        }

        $notify[] = ['success', $notification];
        return to_route('admin.doctor.detail', $doctor->id)->withNotify($notify);
    }

    protected function validation($request, $id = 0)
    {
        $imageValidation = $id ? 'nullable' : 'required';
        $request->validate([
            'image'         => ["$imageValidation", 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'name'          => 'required|string|max:40',
            'username'      => 'required|string|max:40|min:6|unique:doctors,username,' . $id,
            'email'         => 'required|email|string|unique:doctors,email,' . $id,
            // 'mobile'        => 'required|numeric|unique:doctors,mobile,' . $id,
            'department'    => 'required||numeric|gt:0',
            'location'      => 'required||numeric|gt:0',
            'fees'          => 'required|numeric|gt:0',
            'qualification' => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'about'         => 'required|string|max:500',
        ]);
    }

    protected function doctorSave($doctor, $request)
    {
        if ($request->hasFile('image')) {
            try {
                $old = $doctor->image;
                $doctor->image = fileUploader($request->image, getFilePath('doctorProfile'), getFileSize('doctorProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $general = gs();
        $mobile = $general->country_code . $request->mobile;

        $doctor->name               = $request->name;
        $doctor->username           = $request->username;
        $doctor->email              = strtolower(trim($request->email));
        $doctor->password           = encrypt(passwordGen());
        $doctor->mobile             = $mobile;
        $doctor->department_id      = $request->department;
        $doctor->location_id        = $request->location;
        $doctor->qualification      = $request->qualification;
        $doctor->fees               = $request->fees;
        $doctor->revisit_fees       = $request->revisit_fees;
        $doctor->address            = $request->address;
        $doctor->about              = $request->about;
        $doctor->save();
    }

    public function detail($id)
    {
        $doctor            = Doctor::findOrFail($id);
        $pageTitle         = 'Doctor Detail - ' . $doctor->name;
        $departments       = Department::latest()->get();
        $locations         = Location::latest()->get();
        $totalOnlineEarn   = Deposit::where('doctor_id', $doctor->id)->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
        $totalCashEarn     = $doctor->balance - $totalOnlineEarn;
        $totalAppointments = Appointment::where('doctor_id', $doctor->id)->where('try', 1)->count();

        $completeAppointments = Appointment::where('doctor_id', $doctor->id)->where('try', 1)->where('is_complete', Status::YES)->count();
        $trashedAppointments  = Appointment::where('doctor_id', $doctor->id)->where('is_delete', Status::YES)->count();
        return view('admin.doctor.details', compact('pageTitle', 'doctor', 'departments', 'locations', 'totalOnlineEarn', 'totalCashEarn', 'completeAppointments', 'trashedAppointments', 'totalAppointments'));
    }


    public function login($id)
    {
        $doctor = Doctor::findOrFail($id);
        Auth::guard('doctor')->login($doctor);
        return to_route('doctor.dashboard');
    }

    public function notificationLog($id)
    {

        $doctor    = Doctor::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $doctor->username;
        $logs      = NotificationLog::where('doctor_id', $id)->with('doctor')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.doctor.notification_history', compact('pageTitle', 'logs', 'doctor'));
    }

    public function showNotificationSingleForm($id)
    {
        $doctor = Doctor::findOrFail($id);
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.admin.detail', $doctor->id)->withNotify($notify);
        }
        $pageTitle = 'Send Notification to ' . $doctor->username;
        return view('admin.doctor.notification_single', compact('pageTitle', 'doctor'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $doctor = Doctor::findOrFail($id);
        notify($doctor, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return to_route('admin.doctor.notification.log', $doctor->id)->withNotify($notify);
    }


    public function showNotificationAllForm()
    {

        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $doctors = Doctor::active()->count();
        $pageTitle = 'Notification to Verified Doctors';
        return view('admin.doctor.notification_all', compact('pageTitle', 'doctors'));
    }


    public function sendNotificationAll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'subject' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $doctor = Doctor::active()->skip($request->skip)->first();

        if (!$doctor) {
            return response()->json([
                'error' => 'Doctor not found',
                'total_sent' => 0,
            ]);
        }

        notify($doctor, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => 'message sent',
            'total_sent' => $request->skip + 1,
        ]);
    }

    public function loginHistory($id = 0)
    {
        $logs      = DoctorLogin::orderByDesc('id')->searchable(['doctor:username, name'])->with('doctor');
        if ($id) {
            $doctor = Doctor::find($id);
            $pageTitle = $doctor->name. ' '.'Login History';
            $loginLogs = $logs->where('doctor_id', $id)->paginate(getPaginate());
        } else {
            $pageTitle = 'Doctor Login History';
            $loginLogs = $logs->paginate(getPaginate());
        }
        return view('admin.doctor.logins', compact('pageTitle', 'loginLogs'));
    }
}
