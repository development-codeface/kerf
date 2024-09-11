<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Staff;
use App\Models\StaffLogin;
use App\Models\Location;
use App\Models\Department;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManageStaffsController extends Controller
{

    public function index()
    {
        $pageTitle = 'All Staff';
        $staff     = $this->commonQuery()->paginate(getPaginate());
        return view('admin.staff.index', compact('pageTitle', 'staff'));
    }

    public function active($status)
    {
        $pageTitle = 'Active Staff';
        $staff     = $this->commonQuery()->where('status', Status::ACTIVE)->paginate(getPaginate());
        return view('admin.staff.index', compact('pageTitle', 'staff'));
    }

    public function inactive($status)
    {
        $pageTitle = 'Inactive Staff';
        $staff     = $this->commonQuery()->where('status', Status::INACTIVE)->paginate(getPaginate());
        return view('admin.staff.index', compact('pageTitle', 'staff'));
    }

    protected function commonQuery()
    {
        return Staff::orderBy('id', 'DESC')->searchable(['name', 'mobile', 'email'])->filter(['status']);
    }

    public function status($id)
    {
        return Staff::changeStatus($id);
    }

    public function featured($id)
    {
        return Staff::changeStatus($id, 'Featured');
    }

    public function form()
    {
        $pageTitle   = 'Add New Staff';
        return view('admin.staff.form', compact('pageTitle'));
    }

    public function store(Request $request, $id = 0)
    {
        $this->validation($request, $id);
        if ($id) {
            $staff        = Staff::findOrFail($id);
            $notification = 'Staff updated successfully';
        } else {
            $staff        = new Staff();
            $notification = 'Staff added successfully';
        }
        $this->staffSave($staff, $request);
        if (!$id) {
            $general = gs();
            notify($staff, 'PEOPLE_CREDENTIAL', [
                'site_name' => $general->site_name,
                'name'      => $staff->name,
                'username'  => $staff->username,
                'password'  => decrypt($staff->password),
                'guard'     => route('login'),
            ]);
        }
        $notify[] = ['success', $notification];
        return to_route('admin.staff.detail', $staff->id)->withNotify($notify);
    }



    protected function validation($request, $id = 0)
    {
        $imageValidation = $id ? 'nullable' : 'required';
        $request->validate([
            'image'         => ["$imageValidation", 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'name'          => 'required|string|max:40',
            'username'      => 'required|string|max:40|min:6|unique:staff,username,' . $id,
            'email'         => 'required|email|string|unique:staff,email,' . $id,
            'mobile'        => 'required|numeric|unique:staff,mobile,' . $id,
            'address'       => 'nullable|string|max:255',
            'about'         => 'nullable|string|max:500',
        ]);
    }

    protected function staffSave($staff, $request)
    {
        if ($request->hasFile('image')) {
            try {
                $old = $staff->image;
                $staff->image = fileUploader($request->image, getFilePath('staffProfile'), getFileSize('staffProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $general = gs();
        $mobile = $general->country_code . $request->mobile;

        $staff->name               = $request->name;
        $staff->username           = $request->username;
        $staff->email              = strtolower(trim($request->email));
        $staff->password           = encrypt(passwordGen());
        $staff->mobile             = $mobile;
        $staff->save();
    }


    public function detail($id)
    {
        $staff       = Staff::findOrFail($id);
        $pageTitle   = 'Staff Detail - ' . $staff->name;
        $appointment  = Appointment::where('added_staff_id', $staff->id);
        $new   = clone  $appointment;
        $done  = clone  $appointment;
        $total = clone $appointment;
        $trash = clone $appointment;
        $newAppointments     = $new->newAppointment()->count();
        $doneAppointments    = $done->completeAppointment()->count();
        $totalAppointments   = $total->where('try', Status::YES)->count();
        $trashedAppointments = $trash->where('delete_by_staff', $staff->id)->where('is_delete', Status::YES)->count();
        return view('admin.staff.details', compact('pageTitle', 'staff', 'doneAppointments', 'newAppointments', 'trashedAppointments', 'totalAppointments'));
    }


    public function login($id)
    {
        $staff = Staff::findOrFail($id);
        Auth::guard('staff')->login($staff);
        return redirect()->route('staff.dashboard');
    }

    public function notificationLog($id)
    {

        $staff    = Staff::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $staff->username;
        $logs      = NotificationLog::where('staff_id', $id)->with('staff')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.staff.notification_history', compact('pageTitle', 'logs', 'staff'));
    }

    public function showNotificationSingleForm($id)
    {
        $staff = Staff::findOrFail($id);
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.admin.detail', $staff->id)->withNotify($notify);
        }
        $pageTitle = 'Send Notification to ' . $staff->username;
        return view('admin.staff.notification_single', compact('pageTitle', 'staff'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $staff = Staff::findOrFail($id);
        notify($staff, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return to_route('admin.staff.notification.log', $staff->id)->withNotify($notify);
    }


    public function showNotificationAllForm()
    {

        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $staffs = Staff::active()->count();
        $pageTitle = 'Notification to Verified Staffs';
        return view('admin.staff.notification_all', compact('pageTitle', 'staffs'));
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

        $staff = Staff::active()->skip($request->skip)->first();

        if (!$staff) {
            return response()->json([
                'error' => 'Staff not found',
                'total_sent' => 0,
            ]);
        }

        notify($staff, 'DEFAULT', [
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
        $logs      = StaffLogin::orderByDesc('id')->searchable(['staff:username,name'])->with('staff');
        if ($id) {
            $staff = Staff::find($id);
            $pageTitle = $staff->name . ' ' . 'Login History';
            $loginLogs = $logs->where('staff_id', $id)->paginate(getPaginate());
        } else {
            $pageTitle = 'Staff Login History';
            $loginLogs = $logs->paginate(getPaginate());
        }
        return view('admin.staff.logins', compact('pageTitle', 'loginLogs'));
    }
}
