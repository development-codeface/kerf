<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Schedule';
        $doctor = auth()->guard('doctor')->user();
        return view('doctor.schedule.index', compact('pageTitle', 'doctor'));
    }

    public function update(Request $request)
    {
        $request->validate([
                'slot_type'  => 'required|numeric|in:1,2',
                'serial_day' => 'required|numeric|gt:0',
                'start_time' => 'required_if:slot_type,2',
                'end_time'   => 'required_if:slot_type,2',
                'duration'   => 'numeric|required_if:slot_type,2',
                'max_serial' => 'numeric|required_if:slot_type,1',
            ]);

        $doctor = Doctor::findOrFail(auth()->guard('doctor')->user()->id);

        if ($request->slot_type == 1 && $request->max_serial > 0) {

            $serialOrSlot = [];
            for ($i = 1; $i <= $request->max_serial; $i++) {
                array_push($serialOrSlot, "$i");
            }
            $doctor->serial_or_slot = $serialOrSlot;
            $doctor->max_serial = $request->max_serial;
        } elseif ($request->slot_type == 2 && $request->duration > 0) {
            $startTime    = Carbon::parse($request->start_time);
            $endTime      = Carbon::parse($request->end_time);
            
            $start_time_evening = Carbon::parse($request->start_time_evening);
            $end_time_evening = Carbon::parse($request->end_time_evening);
            $totalMinutes = $endTime->diffInMinutes($startTime);
            $totalSlot   = $totalMinutes / $request->duration;

            $evetotalMinutes = $end_time_evening->diffInMinutes($start_time_evening);
            $evetotalSlot   = $evetotalMinutes / $request->duration;

            $serialOrSlot = [];
            for ($i = 1; $i <= $totalSlot; $i++) {
                array_push($serialOrSlot, date('h:i:a', strtotime($startTime)));
                $startTime->addMinutes($request->duration);
            }

            $eveserialOrSlot = [];
            for ($j = 1; $j <= $evetotalSlot; $j++) {
                array_push($eveserialOrSlot, date('h:i:a', strtotime($start_time_evening)));
                $start_time_evening->addMinutes($request->duration);
            }

            // $doctor->serial_or_slot = $serialOrSlot;
            // $doctor->eve_slots = $eveserialOrSlot;
            $doctor->serial_or_slot = array_merge($serialOrSlot, $eveserialOrSlot);
            $doctor->duration       = $request->duration;
            $doctor->start_time     = Carbon::parse($request->start_time)->format('h:i a');
            $doctor->end_time       = Carbon::parse($request->end_time)->format('h:i a');
            $doctor->start_time_evening = Carbon::parse($request->start_time_evening)->format('h:i a');
            $doctor->end_time_evening = Carbon::parse($request->end_time_evening)->format('h:i a');
        } else {
            $notify[] = ['error', 'Select the maximum serial or duration'];
            return back()->withNotify($notify);
        }

        $doctor->slot_type  = $request->slot_type;
        $doctor->serial_day = $request->serial_day;
        $doctor->save();
        $notify[] = ['success', 'Schedule has been updated successfully'];
        return back()->withNotify($notify);
    }
}
//file to change
