<?php

use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Teachers\ProfilerController;
use App\Http\Controllers\Teachers\StudentsOfTeachersController;
use App\Http\Controllers\Teachers\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use PHPUnit\TextUI\XmlConfiguration\Group;

//Students routes

Route::group(
    [
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================

    // the code at repo
    Route::group(['namespace'=>'Dashboard'],function(){
        Route::get('/teacher/Dashboard',[TeacherController::class,'DashboardTeacher']);
        Route::get('/getStudents',[StudentsOfTeachersController::class,'getStudents'])->name('teacher.stuents');
        //              Attendance
        Route::get('/Attendances',[StudentsOfTeachersController::class,'attendance'])->name('teacher.attendance');
        //              //
        Route::get('/getSections',[StudentsOfTeachersController::class,'getSections'])->name('teacehr.sections');

        Route::post('/editAttendance',[AttendanceController::class,'editAttendance'])->name('teacehr.editAendance');

        Route::get('/ReportAttendance',[AttendanceController::class,'ReportAttendance'])->name('teacher.ReportAttendance');

        Route::match(['get','post'],'/SearchAttendance',[AttendanceController::class,'SeachAttendance'])->name('teacher.attendance.search');

        Route::get('/profile',[ProfilerController::class,'index'])->name('profile.index');

        Route::post('/profile/update',[ProfilerController::class,'update'])->name('profile.update');


    });
        ///=>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


});



