<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Assistant;
use App\Models\Doctor;
use App\Models\AssistantLogin;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManageAssistantsController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Assistants';
        $assistants = $this->commonQuery()->paginate(getPaginate());
        return view('admin.assistant.index', compact('pageTitle', 'assistants'));
    }
    public function active($status)
    {
        $pageTitle = 'Active Doctors';
        $assistants = $this->commonQuery()->where('status', Status::ACTIVE)->paginate(getPaginate());
        return view('admin.assistant.index', compact('pageTitle', 'assistants'));
    }
    public function inactive($status)
    {
        $pageTitle = 'Inactive Doctors';
        $assistants = $this->commonQuery()->where('status', Status::INACTIVE)->paginate(getPaginate());
        return view('admin.assistant.index', compact('pageTitle', 'assistants'));
    }

    protected function commonQuery(){
        return Assistant::orderBy('id', 'DESC')->searchable(['name', 'mobile', 'email'])->filter(['status']);
    }

    public function status($id)
    {
        return Assistant::changeStatus($id);
    }

    public function form()
    {
        $pageTitle = 'Add New Assistant';
        $doctors   = Doctor::active()->orderBy('name')->get();
        return view('admin.assistant.form', compact('pageTitle', 'doctors'));
    }

    public function store(Request $request, $id = 0)
    {
        $this->validation($request, $id);
        if ($id) {
            $assistant    = Assistant::findOrFail($id);
            $notification = 'Assistant updated successfully';
        } else {
            $assistant    = new Assistant();
            $notification = 'Assistant added successfully';
        }

        $this->assistantSave($assistant, $request);

        if (!$id) {
            $general = gs();
            notify($assistant, 'PEOPLE_CREDENTIAL', [
                'site_name' => $general->site_name,
                'name'      => $assistant->name,
                'username'  => $assistant->username,
                'password'  => decrypt($assistant->password),
                'guard'     => route('login'),
            ]);
        }
        $notify[] = ['success', $notification];
        return to_route('admin.assistant.detail', $assistant->id)->withNotify($notify);
    }


    protected function validation($request, $id = 0)
    {
        $imageValidation = $id ? 'nullable' : 'required';
        $request->validate([
            'image'    => ["$imageValidation", 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'name'     => 'required|string|max:40',
            'username' => 'required|string|max:40|min:6|unique:assistants,username,' . $id,
            'email'    => 'required|email|string|unique:assistants,email,' . $id,
            'mobile'   => 'required|numeric|unique:assistants,mobile,' . $id,
            'address'  => 'nullable|string|max:255',
        ]);
    }

    protected function assistantSave($assistant, $request)
    {
        $doctors = Doctor::findOrFail($request->doctor_id);

        if ($request->hasFile('image')) {
            try {
                $old = $assistant->image;
                $assistant->image = fileUploader($request->image, getFilePath('assistantProfile'), getFileSize('assistantProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $general = gs();
        $mobile = $general->country_code . $request->mobile;

        $assistant->name     = $request->name;
        $assistant->username = $request->username;
        $assistant->email    = strtolower(trim($request->email));
        $assistant->password = encrypt(passwordGen());
        $assistant->mobile   = $mobile;
        $assistant->address  = $request->address;
        $assistant->save();

        if ($doctors) {
            $assistant->doctors()->sync($doctors->pluck('id'));
        }
    }


    public function detail($id)
    {
        $assistant    = Assistant::findOrFail($id);
        $pageTitle    = 'Assistant Detail - ' . $assistant->name;
        $doctors      = Doctor::orderBy('name')->get();
        $totalDoctors = $assistant->doctors->count();

        $basicQuery          = Appointment::where('try', Status::YES)->where('is_delete', Status::NO)->where('added_assistant_id', $id);
        $totalCount          = clone $basicQuery;
        $completeCount       = clone $basicQuery;
        $newCount            = clone $basicQuery;
        $totalAppointment    = $totalCount->count();
        $completeAppointment = $completeCount->where('is_complete', Status::APPOINTMENT_COMPLETE)->count();
        $newAppointment      = $newCount->where('is_complete', Status::APPOINTMENT_INCOMPLETE)->count();

        return view('admin.assistant.details', compact('pageTitle', 'assistant', 'doctors', 'totalDoctors', 'totalAppointment','completeAppointment', 'newAppointment'));
    }


    public function login($id)
    {
        $assistant = Assistant::findOrFail($id);
        Auth::guard('assistant')->login($assistant);
        return redirect()->route('assistant.dashboard');
    }

    public function notificationLog($id)
    {
        $assistant = Assistant::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $assistant->username;
        $logs      = NotificationLog::where('assistant_id', $id)->with('assistant')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.assistant.notification_history', compact('pageTitle', 'logs', 'assistant'));
    }

    public function showNotificationSingleForm($id)
    {
        $assistant = Assistant::findOrFail($id);
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.admin.detail', $assistant->id)->withNotify($notify);
        }
        $pageTitle = 'Send Notification to ' . $assistant->username;
        return view('admin.assistant.notification_single', compact('pageTitle', 'assistant'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $assistant = Assistant::findOrFail($id);
        notify($assistant, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return to_route('admin.assistant.notification.log', $assistant->id)->withNotify($notify);
    }


    public function showNotificationAllForm()
    {
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $assistants = Assistant::active()->count();
        $pageTitle = 'Notification to Verified Assistants';
        return view('admin.assistant.notification_all', compact('pageTitle', 'assistants'));
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

        $assistant = Assistant::active()->skip($request->skip)->first();

        if (!$assistant) {
            return response()->json([
                'error' => 'Assistant not found',
                'total_sent' => 0,
            ]);
        }

        notify($assistant, 'DEFAULT', [
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
        $logs = AssistantLogin::orderByDesc('id')->searchable(['assistant:username,name'])->with('assistant');
        if ($id) {
            $assistant = Assistant::find($id);
            $pageTitle = $assistant->name. ' '.'Login History';
            $loginLogs = $logs->where('assistant_id', $id)->paginate(getPaginate());
        } else {
            $pageTitle = 'Assistant Login History';
            $loginLogs = $logs->paginate(getPaginate());
        }
        return view('admin.assistant.logins', compact('pageTitle', 'loginLogs'));
    }
}
