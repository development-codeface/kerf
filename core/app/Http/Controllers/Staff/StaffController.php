<?php

namespace App\Http\Controllers\Staff;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\StaffLogin;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function dashboard()
    {
        $pageTitle  = 'Dashboard';
        $basicQuery = Appointment::where('added_staff_id', auth()->guard('staff')->user()->id);
        $new       = clone  $basicQuery;
        $total     = clone  $basicQuery;
        $completed = clone  $basicQuery;
        $newAppointments   = $new->newAppointment()->count();
        $doneAppointments  = $total->completeAppointment()->where('payment_status', Status::APPOINTMENT_PAID_PAYMENT)->count();
        $totalAppointments = $completed->count();
        $appointments      =  $basicQuery->newAppointment()->orderByDesc('id')->with('doctor')->take(10)->get();
        $loginLogs         = StaffLogin::where('staff_id',  auth()->guard('staff')->user()->id)->orderByDesc('id')->with('staff')->take(10)->get();
        return   view('staff.dashboard', compact('pageTitle', 'newAppointments', 'doneAppointments', 'totalAppointments', 'appointments', 'loginLogs'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $staff = auth()->guard('staff')->user();
        return view('staff.profile', compact('pageTitle', 'staff'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ]);
        $staff = auth()->guard('staff')->user();


        if ($request->hasFile('image')) {
            try {
                $old = $staff->image;
                $staff->image = fileUploader($request->image, getFilePath('staffProfile'), getFileSize('staffProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $staff->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return back()->withNotify($notify);
    }


    public function password()
    {
        $pageTitle = 'Password Setting';
        $staff = auth()->guard('staff')->user();
        return view('staff.password', compact('pageTitle', 'staff'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password'     => 'required|min:5|confirmed',
        ]);

        $user = auth()->guard('staff')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return back()->withNotify($notify);
    }


    public function systemInfo()
    {
        $laravelVersion = app()->version();
        $serverDetails  = $_SERVER;
        $currentPHP     = phpversion();
        $timeZone       = config('app.timezone');
        $pageTitle      = 'System Information';
        return view('staff.info', compact('pageTitle', 'currentPHP', 'laravelVersion', 'serverDetails', 'timeZone'));
    }
}
