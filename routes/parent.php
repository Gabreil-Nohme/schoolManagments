<?php

use App\Http\Controllers\Parents\ProfileController;
use App\Http\Controllers\Parents\SonsController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

//Students routes

Route::group(
    [
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/Dashboard', function () {
        $sons = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.dashboard',compact('sons'));
    });
    Route::get('sons/my-sons',[SonsController::class,'index'])->name('sons.index');
    Route::get('sons/resault/{id}',[SonsController::class,'result'])->name('sons.results');
    Route::get('sons/attendace',[SonsController::class,'attendance'])->name('sons.attendance');
    Route::post('sons/attendance/search',[SonsController::class,'attendance_search'])->name('sons.attendance.search');

    Route::get('sons/fees',[SonsController::class,'fees'])->name('sons.fees');
    Route::get('sons/receipt/{id}',[SonsController::class, 'receipt'])->name('sons.receipt');

    Route::get('profile/parents',[ProfileController::class,'index'])->name('parents.profile.index');
    Route::post('profile/store/parents',[ProfileController::class, 'profile'])->name('parents.profile.store');

});

