<?php

use App\Http\Controllers\Controller\Students\dashboard\ExamController;
use App\Http\Controllers\Students\dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

//Students routes

Route::group(
    [
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/Dashboard', function () {
        return view('pages.Students.dashboard');
    });

    Route::group(['namespace' => 'Students\dashboard'], function () {

    Route::resource('/ExamStudent', 'ExamController');
    Route::get('/ExamStudent/{$id}', 'ExamController@show')->name('student_exams.show');
    Route::get('/ExamStudents/refresh/{id}', 'ExamController@refreshStore')->name('student_exams.refresh.store');

    Route::resource('profile-student', 'ProfileController');
    });

});

