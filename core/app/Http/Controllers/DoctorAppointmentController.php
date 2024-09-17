<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Leave;
use App\Models\Location;
use App\Traits\AppointmentManager;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
    use AppointmentManager;

    public function doctors(Request $request)
    {
        $pageTitle   = 'Our Doctors';
        $locations   = Location::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $departments = Department::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $doctors     = Doctor::active();
        if ($request->location) {
            $doctors = $doctors->where('location_id', $request->location);
        }
        if ($request->department) {
            $doctors = $doctors->where('department_id', $request->department);
        }
        if ($request->doctor) {
            $doctors = $doctors->where('id', $request->doctor);
        }
        $doctors = $doctors->orderBy('id', 'DESC')->with('department', 'location')->paginate(getPaginate());
        return view($this->activeTemplate  . 'search', compact('pageTitle', 'locations', 'departments', 'doctors'));
    }

    public function locations($location)
    {
        $pageTitle   = 'Location wise Doctors';
        $locations   = Location::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $departments = Department::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $doctors     = Doctor::active()->where('location_id', $location)->orderBy('id', 'DESC')->with('department', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'search', compact('pageTitle', 'locations', 'departments', 'doctors'));
    }

    public function paymentsuccess()
    {
        $pageTitle   = 'Payment Status';
        $message   = 'Your Payment is successfull!!';
        return view($this->activeTemplate . 'success',compact('pageTitle'));

        
    }

    public function departments($department)
    {
        $pageTitle   = 'Department wise Doctors';
        $locations   = Location::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $departments = Department::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $doctors     = Doctor::active()->where('department_id', $department)->orderBy('id', 'DESC')->with('department', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'search', compact('pageTitle', 'locations', 'departments', 'doctors'));
    }

    public function featured()
    {
        $pageTitle   = 'All featured Doctors';
        $locations   = Location::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $departments = Department::orderBy('id', 'DESC')->whereHas('doctors')->get();
        $doctors     = Doctor::active()->where('featured', Status::YES)->orderBy('id', 'DESC')->with('department', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'search', compact('pageTitle',  'locations', 'departments', 'doctors'));
    }

    public function booking($id = 0)
    {
        $doctor = Doctor::findOrFail($id);
        
        $leaves = Leave::select('id', 'employee_id', 'start_date', 'end_date', 'reason')
        ->where('employee_id', '=', $id)
        ->get();
        if (!$doctor->status) {
            $notify[] = ['error', 'This doctor is inactive!'];
            return to_route('doctors.all')->withNotify($notify);
        }
        // print_r($leaves);
        foreach ($leaves as $key => $value) {
            // echo $value;
            $startDate = Carbon::parse($value->start_date);
            $endDate = Carbon::parse($value->end_date);

            $dates = [];

            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }

            // print_r($dates);
        }
        $pageTitle = $doctor->name . ' - Booking';
        $availableDate = [];
        $date = Carbon::now();
        for ($i = 0; $i < $doctor->serial_day; $i++) {
            if (!in_array(date('Y-m-d', strtotime($date)), $dates)) {
                array_push($availableDate, date('Y-m-d', strtotime($date)));
            }  
            $date->addDays(1);
        }
        // print_r($availableDate);
        return view($this->activeTemplate . 'booking',  compact('availableDate', 'doctor', 'pageTitle'));
    }
}
