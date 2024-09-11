<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Auth')->controller('LoginController')->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
    // Staff Password Reset
    Route::controller('ForgotPasswordController')->group(function(){
        Route::get('password/reset', 'showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'sendResetCodeEmail');
        Route::get('password/code-verify', 'codeVerify')->name('password.code.verify');
        Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
    });

    Route::controller('ResetPasswordController')->group(function(){
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'reset')->name('password.change');
    });
});

Route::middleware('staff')->group(function () {
    Route::controller('StaffController')->group(function(){
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');

        //Notification
        Route::get('notifications','notifications')->name('notifications');
        Route::get('notification/read/{id}','notificationRead')->name('notification.read');
        Route::get('notifications/read-all','readAll')->name('notifications.readAll');

    });

    Route::controller('AppointmentController')->prefix('appointment')->name('appointment.')->group( function(){
        //Create Appointment
        Route::get('form', 'form')->name('form');

        Route::get('details', 'details')->name('book.details');
        Route::get('booked/date/check', 'availability')->name('available.date');
        Route::post('store/{id}', 'store')->name('store');

        //Appointment
        Route::post('dealing/{id}', 'done')->name('dealing');

        Route::get('new', 'new')->name('new');
        Route::get('service/done', 'doneService')->name('done');

        Route::post('remove/{id}', 'remove')->name('remove');
        Route::get('trashed', 'serviceTrashed')->name('trashed');
    });

    //System-info
    Route::get('system-info', 'AccountantController@systemInfo')->name('system.info');

});

