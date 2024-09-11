<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Auth')->controller('LoginController')->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');

    // Accountant Password Reset
    Route::controller('ForgotPasswordController')->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'sendResetCodeEmail');
        Route::get('password/code-verify', 'codeVerify')->name('password.code.verify');


        Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
    });

    Route::controller('ResetPasswordController')->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'reset')->name('password.change');
    });
});

Route::middleware('assistant')->group(function () {
    Route::controller('AssistantController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');

        //Notification
        Route::get('notifications', 'notifications')->name('notifications');
        Route::get('notification/read/{id}', 'notificationRead')->name('notification.read');
        Route::get('notifications/read-all', 'readAll')->name('notifications.readAll');

        //Report Bugs
        Route::get('request-report', 'requestReport')->name('request.report');
        Route::post('request-report', 'reportSubmit');

        //doctors
        Route::get('doctors', 'doctors')->name('doctors');
        Route::get('doctor/appointment/completed/{id}', 'appointmentCompleted')->name('doctor.appointment.completed');
        Route::get('doctor/appointment/new/{id}', 'appointmentNew')->name('doctor.appointment.new');
        Route::get('doctor/appointment/trash/{id}', 'appointmentTrashed')->name('doctor.appointment.trash');
    });


    //Appointments
    Route::controller('AppointmentController')->prefix('doctor/appointment')->name('doctor.appointment.')->group(function () {
        Route::get('details', 'details')->name('book.details');
        Route::get('booking/availability', 'availability')->name('available.date');
        Route::post('store/{id}', 'store')->name('store');
        //Appointment
        Route::get('form', 'createForm')->name('create.form');
        Route::post('dealing/{id}', 'done')->name('dealing');

        Route::get('service/done', 'doneService')->name('done');
        Route::post('remove/{id}', 'remove')->name('remove');
    });


    //System-info
    Route::get('system-info', 'AssistantController@systemInfo')->name('system.info');
});
