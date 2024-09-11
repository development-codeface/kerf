<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Leave;
use Carbon\Carbon;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Manage Leaves';
        $doctor = auth()->guard('doctor')->user();
        $leaves = Leave::selectRaw('
            *,
            TIMESTAMPDIFF(DAY, start_date, end_date) AS leave_days
        ')->where('employee_id', $doctor->id)->get();
        // echo $doctor = Doctor::findOrFail(auth()->guard('doctor')->user()->id);
        // return view('doctor.leaves.index');
        return view('doctor.schedule.leave', compact('pageTitle', 'doctor','leaves'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor = Doctor::findOrFail(auth()->guard('doctor')->user()->id);
        $leave = new Leave();
        // $leave = Leave::findOrFail();
        // print_r($_POST);exit;
        $leave->employee_id = $request->input('employee_id');
        $leave->start_date = $request->input('start_date');
        $leave->end_date = $request->input('end_date');
        $leave->leave_type = $request->input('leave_type');
        $leave->reason = $request->input('reason');
        $leave->save();

        return redirect()->route('doctor.leave.index')->with('success', 'Leave request submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->route('doctor.leave.index')->with('success', 'Leave request deleted successfully!');
    }
}
