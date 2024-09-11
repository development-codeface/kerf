<?php

namespace App\Http\Controllers\Assistant;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AssistantDoctorTrack;
use App\Models\AssistantLogin;
use App\Models\Doctor;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AssistantController extends Controller
{
    public function dashboard()
    {
        $pageTitle   = 'Dashboard';
        $assistant   = auth()->guard('assistant')->user();
        $doctors     = $assistant->doctors;
        $totalDoctor = $doctors->count();

        $basicQuery = Appointment::where('try', Status::YES)->where('is_delete', Status::NO)->where('added_assistant_id', $assistant->id);

        $completeCount = clone $basicQuery;
        $newCount      = clone $basicQuery;
        $completeAppointment = $completeCount->where('is_complete', Status::APPOINTMENT_COMPLETE)->count();
        $newAppointment      = $newCount->where('is_complete', Status::APPOINTMENT_INCOMPLETE)->count();

        $loginLogs  = AssistantLogin::where('assistant_id',  $assistant->id)->orderByDesc('id')->with('assistant')->take(10)->get();

        return view('assistant.dashboard', compact('pageTitle', 'assistant', 'totalDoctor', 'completeAppointment', 'newAppointment', 'doctors', 'loginLogs'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $assistant = auth()->guard('assistant')->user();
        return view('assistant.profile', compact('pageTitle', 'assistant'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ]);
        $assistant = auth()->guard('assistant')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $assistant->image;
                $assistant->image = fileUploader($request->image, getFilePath('assistantProfile'), getFileSize('assistantProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $assistant->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return back()->withNotify($notify);
    }

    public function doctors()
    {
        $pageTitle = 'Assistant of Doctors';
        $assistantDoctors = AssistantDoctorTrack::where('assistant_id', auth()->guard('assistant')->id())->with(['doctor' => function($q){
                            $q->withCount(['appointments' => function($a){
                                $a->newAppointment();
                            }]);
        },'doctor.location', 'doctor.department'])->get()->sortByDesc('appointments_count');

        return view('assistant.doctor.index', compact('pageTitle', 'assistantDoctors'));
    }

    public function appointmentCompleted($id)
    {
        $doctor       = Doctor::with('appointments')->findOrFail($id);
        $pageTitle    = $doctor->name .' - '.'Done Appointments';
        $appointments = Appointment::completeAppointment()->where('doctor_id',$doctor->id)->searchable(['name', 'email', 'disease'])->with('staff', 'doctor', 'assistant')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('assistant.doctor.appointments', compact('pageTitle', 'appointments'));
    }

    public function appointmentNew($id)
    {
        $doctor       = Doctor::with('appointments')->findOrFail($id);
        $pageTitle    = $doctor->name .' - '.'New Appointments';
        $appointments = Appointment::newAppointment()->where('doctor_id',$doctor->id)->with('staff', 'doctor', 'assistant')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('assistant.doctor.appointments', compact('pageTitle', 'appointments'));
    }
    public function AppointmentTrashed($id)
    {
        $doctor       = Doctor::with('appointments')->findOrFail($id);
        $pageTitle    = $doctor->name .' - '.'Trashed Appointments';
        $appointments = Appointment::where('doctor_id', $id)->where('is_delete', Status::YES)->searchable(['name', 'email', 'disease'])->with('staff', 'doctor', 'assistant')->orderBy('id', 'DESC');

        $appointments = $appointments->paginate(getPaginate());
        return view('assistant.doctor.appointments', compact('pageTitle', 'appointments'));
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $assistant = auth()->guard('assistant')->user();
        return view('assistant.password', compact('pageTitle', 'assistant'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password'     => 'required|min:5|confirmed',
        ]);

        $user = auth()->guard('assistant')->user();
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
        return view('assistant.info', compact('pageTitle', 'currentPHP', 'laravelVersion', 'serverDetails', 'timeZone'));
    }

}
