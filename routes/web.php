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
    Route::get('/lessons/filter/{id}', 'LessonController@filter')->name('lesson_filter');
    Route::resource('exercises', 'ExerciseController');
});

Route::group(['namespace' => 'User', 'prefix' => 'settings'], function() {
    Route::get('/', 'ProfileController@index')->name('settings');
    Route::get('email', 'ProfileController@showEmail')->name('show.email');
    Route::get('information', 'ProfileController@showInformation')->name('show.information');
    Route::get('localization', 'ProfileController@showLocalization')->name('show.localization');

});

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'courses'], function() {
    Route::get('/', 'HomeController@course')->name('courses');
    Route::get('/{course}', 'HomeController@showLessons')->name('course.lessons');
});

Auth::routes();
