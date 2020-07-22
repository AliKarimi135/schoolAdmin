<?php

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


Auth::routes();
Route::get('register',function (){
    return redirect()->route('login');
});
Route::group(['middleware'=>'auth'],function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('book','BookController');
    Route::get('book/search/{id}','BookController@search')->name('book.search');
    Route::get('book/search/{base}/{type}/{expertise}','BookController@resultSearch')->name('book.result.search');
    Route::resource('classroom','ClassRoomController');
    Route::resource('teachers','TeacherController');
    Route::get('teachers/search/{id}','TeacherController@search')->name('teachers.search');
    Route::get('teachers/search/{id}/{expertise}','TeacherController@resultSearch')->name('teachers.result.search');
    Route::resource('student','StudentController');
    Route::get('student/search/{id}','StudentController@search')->name('student.search');
    Route::get('student/search/{id}/{class_id}','StudentController@resultSearch')->name('student.result.search');

    Route::get('search/base','BookController@getBookByBase');
    Route::resource('course','CourseController');
    Route::post('course/search','CourseController@searchCourse')->name('searchCourse');
    Route::get('team','CourseController@showTeam')->name("showTeam");
    Route::get('team/classId','CourseController@getCourseByclassId');
    Route::post('team/classId/bookId','CourseController@getTeam')->name("getTeam");
    Route::get('team/changeId/teamId','CourseController@setTeam')->name("setTeam");

    //Route::resource('mark','MarkController');
    Route::get('mark','MarkController@index')->name('mark.index');
    Route::post('mark','MarkController@searchStudent')->name('mark.searchStudent');
    Route::get('mark/classId','MarkController@getBookByClassId')->name('mark.getBookByClassId');
    Route::get('mark/{studentId}/{bookId}/{studentName}','MarkController@showMark')->name('mark.showMark');
});
Route::group(['prefix'=>'api/v1/'],function (){
    Route::post('register','UserAppController@registerUserApp')->name("registerUserApp");
    Route::post('users/login','UserAppController@loginUserApp')->name("loginUserApp");
    Route::get('course','UserAppController@getCourse');
    Route::get('student','UserAppController@getStudents');
    Route::get('get/mark','UserAppController@getMarks');
    Route::post('set/mark','UserAppController@setMark');
    Route::put('update/mark/{id}','UserAppController@updateMark');
    Route::delete('delete/mark/{id}','UserAppController@destroyMark');


});
