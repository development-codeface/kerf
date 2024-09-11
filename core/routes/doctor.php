<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Auth')->controller('LoginController')->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');

    //  Password Reset
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

Route::middleware('doctor')->group(function () {
    Route::controller('DoctorController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');


        //Notification
        Route::get('notifications', 'notifications')->name('notifications');
        Route::get('notification/read/{id}', 'notificationRead')->name('notification.read');
        Route::get('notifications/read-all', 'readAll')->name('notifications.readAll');

        //Report Bugs
        Route::get('request-report', 'requestReport')->name('request.report');
        Route::post('request-report', 'reportSubmit');

        Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');
    });

    Route::controller('DoctorController')->prefix('information')->name('info.')->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('about', 'about')->name('about');
        Route::post('update', 'aboutUpdate')->name('about.update');
        Route::get('speciality', 'speciality')->name('speciality');
        Route::post('speciality-update', 'specialityUpdate')->name('speciality.update');

        Route::get('educations', 'educations')->name('educations');
        Route::post('education-store/{id?}', 'educationStore')->name('education.store');
        Route::post('education-delete/{id}', 'educationDelete')->name('education.delete');

        Route::get('experiences', 'experiences')->name('experiences');
        Route::post('experience-store/{id?}', 'experienceStore')->name('experience.store');
        Route::post('experience-delete/{id}', 'experienceDelete')->name('experience.delete');

        Route::get('social-icons', 'socialIcons')->name('social.icon');
        Route::post('social-icon-store/{id?}', 'socialIconStore')->name('social.icon.store');
        Route::post('social-icon-delete/{id}', 'socialIconDelete')->name('social.icon.delete');
    });

    //Schedule//
    Route::controller('ScheduleController')->name('schedule.')->prefix('schedule')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('update', 'update')->name('update');
       
        
    });
    

    //Leave//
    Route::controller('LeaveController')->name('leave.')->prefix('leave')->group(function () {
        Route::get('index', 'index')->name('index');
        // Route::post('update', 'update')->name('update');
        Route::post('store', 'store')->name('store');
        Route::post('destroy', 'destroy')->name('destroy');
        
    });
    Route::delete('leave/{id}', 'LeaveController@destroy')->name('leave.destroy');
    //Appointments
    Route::controller('AppointmentController')->prefix('appointment')->name('appointment.')->group(function () {
        Route::get('booking', 'details')->name('booking');
        Route::get('booking/availability/date', 'availability')->name('available.date');
        Route::post('store/{id}', 'store')->name('store');

        //Appointment
        Route::get('new', 'new')->name('new');
        Route::post('dealing/{id}', 'done')->name('dealing');

        Route::get('service/done', 'doneService')->name('done');

        Route::post('remove/{id}', 'remove')->name('remove');
        Route::get('trashed', 'serviceTrashed')->name('trashed');
    });


});
