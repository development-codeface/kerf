<?php

namespace App\Http\Controllers\Doctor;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AssistantDoctorTrack;
use App\Models\Deposit;
use App\Models\DoctorLogin;
use App\Models\Education;
use App\Models\Experience;
use App\Models\SocialIcon;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $pageTitle   = 'Dashboard';
        $doctor      = auth()->guard('doctor')->user();
        $appointment = Appointment::where('doctor_id', $doctor->id)->where('try', Status::YES)->where('is_delete', Status::NO);
        $new  = clone $appointment;
        $done = clone $appointment;
        $widget['total_online_earn']      = Deposit::where('doctor_id', $doctor->id)->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
        $widget['total_cash_earn']        = $doctor->balance - $widget['total_online_earn'];
        $widget['total_new_appointment']  = $new->where('is_complete', Status::APPOINTMENT_INCOMPLETE)->count();
        $widget['total_done_appointment'] = $done->where('is_complete', Status::APPOINTMENT_COMPLETE)->count();

        $assistantsDoctor  = AssistantDoctorTrack::where('doctor_id', auth()->guard('doctor')->id())->with('assistant')->whereHas('assistant', function ($q) {
            $q->active();
        })->paginate(getPaginate());
        $loginLogs      = DoctorLogin::where('doctor_id',  $doctor->id)->orderByDesc('id')->with('doctor')->take(10)->get();
        return view('doctor.dashboard', compact('pageTitle', 'widget', 'doctor', 'assistantsDoctor', 'loginLogs'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $doctor    = auth()->guard('doctor')->user();
        return view('doctor.info.profile', compact('pageTitle', 'doctor'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ]);
        $doctor = auth()->guard('doctor')->user();

        if ($request->hasFile('image')) {
            try {
                $doctor->image = fileUploader($request->image, getFilePath('doctorProfile'), getFileSize('doctorProfile'), $doctor->image, false);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $doctor->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return back()->withNotify($notify);
    }

    public function about()
    {
        $pageTitle = 'About';
        $doctor = auth()->guard('doctor')->user();
        return view('doctor.info.about', compact('pageTitle', 'doctor'));
    }

    public function aboutUpdate(Request $request)
    {

        $this->validate($request, [
            'about' => 'required',
        ]);
        $doctor = auth()->guard('doctor')->user();
        $doctor->about = $request->about;
        $doctor->save();

        $notify[] = ['success', 'About you has been updated'];
        return back()->withNotify($notify);
    }

    public function speciality()
    {
        $pageTitle = 'Speciality';
        $specialities = auth()->guard('doctor')->user()->speciality;
        return view('doctor.info.speciality', compact('pageTitle', 'specialities'));
    }

    public function specialityUpdate(Request $request)
    {
        $request->validate([
            'speciality.*' => 'sometimes|required',
        ], [
            'speciality.*.required' => 'Speciality field is required',
        ]);

        $speciality = auth()->guard('doctor')->user();
        $speciality->speciality = $request->speciality;
        $speciality->save();
        $notify[] = ['success', 'Specialities has been updated'];
        return back()->withNotify($notify);
    }

    public function educations()
    {
        $pageTitle = 'All EducationS';
        $educations = Education::where('doctor_id', auth()->guard('doctor')->user()->id)->searchable(['institution', 'discipline', 'Period'])->paginate(getPaginate());
        return view('doctor.info.education', compact('pageTitle', 'educations'));
    }

    public function educationStore(Request $request, $id = 0)
    {
        $this->validate($request, [
            'institution' => 'required|max:255',
            'discipline'  => 'required|max:255',
            'period'      => 'required|max:40',
        ]);
        if ($id) {
            $education    = Education::findOrFail($id);
            $notification = 'Education updated successfully';
        } else {
            $education    = new Education();
            $notification = 'Education added successfully';
        }
        $education->doctor_id   = auth()->guard('doctor')->user()->id;
        $education->institution = $request->institution;
        $education->discipline  = $request->discipline;
        $education->period      = $request->period;
        $education->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function educationDelete($id)
    {
        Education::findOrFail($id)->delete();
        $notify[] = ['success', 'Education deleted successfully'];
        return back()->withNotify($notify);
    }

    public function experiences()
    {
        $pageTitle = 'All Experiences';
        $experiences = Experience::where('doctor_id', auth()->guard('doctor')->user()->id)->searchable(['institution', 'discipline', 'Period'])->paginate(getPaginate());
        return view('doctor.info.experiences', compact('pageTitle', 'experiences'));
    }

    public function experienceStore(Request $request, $id = 0)
    {
        $this->validate($request, [
            'institution' => 'required|max:255',
            'discipline'  => 'required|max:255',
            'period'      => 'required|max:40',
        ]);
        if ($id) {
            $Experience    = Experience::findOrFail($id);
            $notification = 'Experience updated successfully';
        } else {
            $Experience    = new Experience();
            $notification = 'Experience added successfully';
        }
        $Experience->doctor_id   = auth()->guard('doctor')->user()->id;
        $Experience->institution = $request->institution;
        $Experience->discipline  = $request->discipline;
        $Experience->period      = $request->period;
        $Experience->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function experienceDelete($id)
    {
        Experience::findOrFail($id)->delete();
        $notify[] = ['success', 'Experience deleted successfully'];
        return back()->withNotify($notify);
    }

    public function socialIcons()
    {
        $pageTitle = 'All Social Icon ';
        $socialIcons = SocialIcon::where('doctor_id', auth()->guard('doctor')->user()->id)->searchable(['title'])->paginate(getPaginate());
        return view('doctor.info.social_icon', compact('pageTitle', 'socialIcons'));
    }

    public function socialIconStore(Request $request, $id = 0)
    {
        $this->validate($request, [
            'title' => 'required|max:40',
            'icon'  => 'required|max:40',
            'url'      => 'required|max:255',
        ]);

        if ($id) {
            $SocialIcon   = Experience::findOrFail($id);
            $notification = 'Social icon updated successfully';
        } else {
            $SocialIcon   = new SocialIcon();
            $notification = 'Social icon added successfully';
        }
        $SocialIcon->doctor_id = auth()->guard('doctor')->user()->id;
        $SocialIcon->title     = $request->title;
        $SocialIcon->icon      = $request->icon;
        $SocialIcon->url       = $request->url;
        $SocialIcon->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function socialIconDelete($id)
    {
        SocialIcon::findOrFail($id)->delete();
        $notify[] = ['success', 'Social icon deleted successfully'];
        return back()->withNotify($notify);
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $doctor = auth()->guard('doctor')->user();
        return view('doctor.password', compact('pageTitle', 'doctor'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth()->guard('doctor')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('doctor.password')->withNotify($notify);
    }
}
