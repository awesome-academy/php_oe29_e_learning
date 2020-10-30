<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Alert;
use Carbon\Carbon;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::paginate(config('paginate.lesson_number'));
        $courses = Course::all();

        return view('admin.component.lessons', compact('lessons', 'courses'));
    }

    public function filter($id) {
        if ($id == config('filter.default')) {
            $lessons = Lesson::paginate(config('paginate.lesson_number'));

            return view('layouts.table', compact('lessons'));
        } else {
            $course = Course::findOrFail($id);
            $lessons = Lesson::where('course_id', $course->id)->paginate(config('paginate.lesson_number'));

            return view('layouts.table', compact('lessons'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        DB::transaction(function() use($request) {
            try {
                if(count($request->title) > 0) {
                    foreach($request->title as $index => $value) {
                        $arrayData[] = [
                            'title' => $request->title[$index],
                            'description' => $request->description[$index],
                            'video_url' => $request->video_url[$index],
                            'course_order' => $request->course_order[$index],
                            'course_id' => $request->course_id,
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString(),
                        ];
                    }
                    Lesson::insert($arrayData);
                    Alert::success(trans('label.created_success'));
                }
            } catch (Exception $exception) {
                Alert::error(trans('label.created_fail'));
            }
        });
    
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
