<?php

use App\Http\Controllers\Grades\GradesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\ClassRoomsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Students\PromotionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//if user cant login redirect login
Route::group(['middleware'=>'guest'],function(){
    Route::get('/',function(){
        return view('auth.login');
    });
});


Route::group(['middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function()
{

    //     section Routes    //
    Route::resource('Sections', 'SectionController');
    Route::get('/classes/{id}', 'SectionController@getclasses');

	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/destroy', 'ClassRoomsController@destroy')->name('delete_all');
    Route::resource('/classes', 'ClassRoomsController');
    Route::post('delete_all','ClassRoomsController@delete_all')->name('delete_all');
    Route::post('Filter_Classes','ClassRoomsController@Filter_Classes')->name('Filter_Classes');
    Route::resource('/sections','SectionController');

    Route::group(['namespace'=>'Grades'],function(){
    Route::resource('/grades', 'GradesController');
    Route::post('delete_all','GradesController@delete_all_grade')->name('delete_all_grade');

    });

    Route::get('/test_livewire',function(){
        return view('test_livewire');
    });

    ////// parents
    Route::view('add_parent','form_page');
    Route::resource('/teachers','TeacherController');

    //students
    Route::group(['namespace'=>'Students'],function(){
    Route::resource('/addStudent','StudentController');
    Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
    Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');

        //images for student
    Route::post('/Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
    Route::get('/Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
    Route::post('/Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        //promotion controller
        Route::resource('/Promotion','PromotionController');

        //graduated
        Route::resource('/graduated','GraduatedController');
        Route::post('/graduated','GraduatedController@OneSoftDelete')->name('graduated.OneSoftDelete');

        //fees
        Route::resource('/Fees','FeeController');
        Route::resource('/FeeInvoices','FeeInvoiceController');
});
});
Auth::routes();


