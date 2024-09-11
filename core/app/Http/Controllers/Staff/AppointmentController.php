<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Traits\AppointmentManager;

class AppointmentController extends Controller
{
    use AppointmentManager;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('staff');
            return $next($request);
        });

        $this->userType   = 'staff';
    }
}
