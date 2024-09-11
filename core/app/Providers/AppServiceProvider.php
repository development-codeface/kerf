<?php

namespace App\Providers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Appointment;
use App\Models\Deposit;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\SupportTicket;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $general = gs();
        $activeTemplate = activeTemplate();
        $viewShare['general']            = $general;
        $viewShare['activeTemplate']     = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['language']           = Language::all();
        $viewShare['emptyMessage']       = 'Data not found';
        view()->share($viewShare);


        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'pendingTicketCount'   => SupportTicket::whereIN('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count(),
                'pendingDepositsCount' => Deposit::pending()->count(),
                'newAppointmentsCount' => Appointment::newAppointment()->hasDoctor()->count(),
            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('is_read', Status::NO)->with('doctor')->orderBy('id', 'desc')->take(10)->get(),
                'adminNotificationCount' => AdminNotification::where('is_read', Status::NO)->count(),
            ]);
        });

        /**
         * * This is the area for doctor guard!
         */
        view()->composer('doctor.partials.sidenav', function ($view) {
            $view->with([
                'newAppointmentsCount' => Appointment::where('doctor_id', auth()->guard('doctor')->id())->newAppointment()->hasDoctor()->count(),
            ]);
        });
        /**
         * * This is the area for staff guard!
         */
        view()->composer('staff.partials.sidenav', function ($view) {
            $view->with([
                'newAppointmentsCount' => Appointment::where('added_staff_id', auth()->guard('staff')->id())->newAppointment()->hasDoctor()->count(),
            ]);
        });


        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if ($general->force_ssl && false) {
            \URL::forceScheme('https');
        }


        Paginator::useBootstrapFour();
    }
}
