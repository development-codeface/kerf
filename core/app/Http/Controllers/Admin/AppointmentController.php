<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Traits\AppointmentManager;


class AppointmentController extends Controller
{

    use AppointmentManager;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('admin')->user();
            return $next($request);
        });

        $this->userType   = 'admin';
    }
}
