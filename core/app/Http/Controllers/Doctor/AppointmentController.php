<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Traits\AppointmentManager;

class AppointmentController extends Controller
{
    use AppointmentManager;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('doctor')->user();
            return $next($request);
        });
        $this->userType   = 'doctor';
        $this->userColumn = 'doctor_id';
    }
}
