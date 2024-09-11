<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Traits\AppointmentManager;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    use AppointmentManager;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('assistant')->user();
            return $next($request);
        });

        $this->userType   = 'assistant';
    }

    public function createForm()
    {
        $pageTitle = 'Make Appointment';
        $assistant = Auth::guard('assistant')->user();
        $doctors = $assistant->doctors()->active()->orderBy('name')->get();
        return view($this->userType . '.appointment.form', compact('pageTitle', 'doctors'));
    }
}
