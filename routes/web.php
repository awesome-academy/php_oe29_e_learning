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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/mentors', 'DashboardController@getAllMentors')->name('admin.mentors');
    Route::get('/lessons/filter/{id}', 'LessonController@filter')->name('lesson_filter');
    Route::group(['as' => 'students.', 'prefix' => 'students'], function() {
        Route::get('/', 'StudentController@index')->name('index');
        Route::get('/exercises', 'StudentController@exercises')->name('exercises');
        Route::patch('/accept/{exercise}', 'StudentController@acceptExercise')->name('accept');
        Route::patch('/reject/{exercise}', 'StudentController@rejectExercise')->name('reject');
    });
    Route::resource('courses', 'CourseController');
    Route::resource('lessons', 'LessonController');
    Route::resource('exercises', 'ExerciseController');
});

Route::group(['namespace' => 'User'], function() {
    Route::post('/rate/{mentor}', 'StudentController@storeRating')->name('rating.mentor');
    Route::group(['prefix' => 'settings'], function() {
        Route::get('/', 'ProfileController@index')->name('settings');
        Route::group(['as' => 'show.'], function() {
            Route::get('email', 'ProfileController@showEmail')->name('email');
            Route::get('information', 'ProfileController@showInformation')->name('information');
            Route::get('localization', 'ProfileController@showLocalization')->name('localization');
            Route::get('github', 'ProfileController@showGithub')->name('github');
        });
    });
    Route::patch('/update/{user}', 'ProfileController@update')->name('update');
    Route::post('/avatar/{user}', 'ProfileController@postAvatar')->name('avatar.store');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'mentors'], function() {
    Route::get('/', 'HomeController@showMentors')->name('mentor');
});
Route::group(['prefix' => 'courses'], function() {
    Route::group(['namespace' => 'User'], function() {
        Route::group(['as' => 'course.'], function() {
            Route::get('/lesson/{id}', 'StudentController@showLessonById')->name('lesson');
            Route::get('/ajax/{id}', 'StudentController@ajaxShowLesson')->name('ajax');
            Route::post('/comment/{course}', 'StudentController@storeCourseComment')->name('comment');
            Route::post('/postEnroll', 'StudentController@storeEnrollCourse')->name('postEnroll');
            Route::get('/enroll/{course}', 'StudentController@enrollCourse')->name('enroll');
        });
        Route::group(['prefix' => 'lessons', 'as' => 'lesson.'], function() {
            Route::post('/comment/{lesson}', 'StudentController@storeLessonComment')->name('comment');
            Route::get('/enrollLesson/{id}', 'StudentController@enrollLesson')->name('enroll');
            Route::post('/request', 'StudentController@bookMentor')->name('mentor');
            Route::post('/exercises/submit', 'StudentController@storeExercise')->name('submit');
        });
    });
    Route::get('/', 'HomeController@course')->name('courses');
    Route::get('/{course}', 'HomeController@showLessons')->name('course.lessons');
    
});
Route::group(['namespace' => 'Mentor', 'prefix' => 'mentor', 'as' => 'mentor.', 'middleware' => 'mentor'], function() {
    Route::get('/', 'MentorController@index')->name('request');
    Route::get('/history', 'MentorController@showRequestHistory')->name('history');
    Route::patch('/accept/{advisor}', 'MentorController@acceptRequest')->name('accept');
});
Route::post('/language', 'LangController@changeLang')->name('localization.change');
Auth::routes();
