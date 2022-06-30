<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Grades\GradesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\ClassRoomsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Quizz\QuizzController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\OnlineClasseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\SubjectController;

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
//and then go to [Controller->Auth->LoginController]

Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/','HomeController@index')->name('selection');

Route::get('/Dashboard','HomeController@Dashboard')->name('Dashboard');
});

Route::group(['namespace' => 'Auth'], function () {
    //from [page selection] go to login form
    Route::get('/login/{type}','LoginController@loginForm')->middleware('guest')->name('login.show');
    //after login go to dashboard
    Route::post('/login','LoginController@login')->name('login');
    //logout
    Route::get('/logout/{type}','LoginController@logout')->name('logout');

    });





//===================================================================//
Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web,teacher']
], function () {

    Route::group(['namespace' => 'Students'], function () {
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
        //online Classes
        Route::resource('online_classes', 'OnlineClasseController');
        Route::get('indirect', 'OnlineClasseController@indirectCreate')->name('indirect.create');
        Route::post('storeIndirect', 'OnlineClasseController@storeIndirect')->name('indirect.store');

    });
                 ////////////////////// Quizz
     Route::group(['namespace' => 'Quizies'], function () {
        Route::resource('Quizzes', 'QuizzController');

    });
                  ////////////////////// Quistions
     Route::group(['namespace' => 'Questions'], function () {
        Route::resource('questions', 'QuestionController');
        Route::get('questions/test/{id}', 'QuestionController@delete')->name('question.delete');

    });
});
    Route::group([
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:web' ]
    ], function () {

    //     section Routes    //
    Route::resource('Sections', 'SectionController');
    Route::get('/classes/{id}', 'SectionController@getclasses');

    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/destroy', 'ClassRoomsController@destroy')->name('delete_all');
    Route::resource('/classes', 'ClassRoomsController');
    Route::post('delete_all', 'ClassRoomsController@delete_all')->name('delete_all');
    Route::post('Filter_Classes', 'ClassRoomsController@Filter_Classes')->name('Filter_Classes');
    Route::resource('/sections', 'SectionController');

    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('/grades', 'GradesController');
        Route::post('delete_all', 'GradesController@delete_all_grade')->name('delete_all_grade');
    });

    Route::get('/test_livewire', function () {
        return view('test_livewire');
    });

    ////// parents
    Route::view('add_parent', 'form_page')->name('add_parent');

    //students
    Route::group(['namespace' => 'Students'], function () {

        Route::resource('/addStudent', 'StudentController');
        //images for student
        Route::post('/Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('/Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('/Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        //promotion controller
        Route::resource('/Promotion', 'PromotionController');

        //graduated
        Route::resource('/graduated', 'GraduatedController');
        Route::post('/graduated', 'GraduatedController@OneSoftDelete')->name('graduated.OneSoftDelete');

        //fees
        Route::resource('/Fees', 'FeeController');
        //Fee_invoices
        Route::resource('/FeeInvoices', 'FeeInvoiceController');
        //receipt_students
        Route::resource('/receipt_students', 'ReceiptStudentController');
        //Route::post('/receipt_students','ReceiptStudentController@show')->name('receipt_students.show');
        //Processing fee
        Route::resource('/Processing_fee', 'ProcessingFeeController');

        //Payment students
        Route::resource('/Payment_students', 'PaymentController');

        //Attendance
        Route::resource('/Attendance', 'AttendanceController');

        //Subjects
        Route::resource('subject', 'SubjectController');


        //library
        Route::resource('library','LibraryController');
        Route::get('download_file/{filename}','LibraryController@download')->name('downloadAttachment');
    });



    Route::group(['namespace' => 'Setting'], function () {
        Route::resource('settings', 'SettingController');
    });

    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('/teachers', 'TeacherController');
    });


});
//Auth::routes();

//=>Controller->HomeController
//stop Laravel Auth
