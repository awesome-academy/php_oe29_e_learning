<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::resource('courses', 'CourseController');
    Route::resource('lessons', 'LessonController');
});

Route::group(['namespace' => 'User'], function() {
    Route::get('/settings', 'ProfileController@index')->name('settings');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'courses'], function() {
    Route::get('/', 'HomeController@course')->name('courses');
    Route::get('/{course}', 'HomeController@showLessons')->name('course.lessons');
});

Auth::routes();
