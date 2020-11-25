<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CourseRequest;
use Alert;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Repositories\Course\CourseRepositoryInterface;

class CourseController extends Controller
{
    protected $courseRepo;

    public function __construct(CourseRepositoryInterface $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepo->getAll(['image'], config('paginate.course_number'));

        return view('admin.component.course', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.component.add_course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $path = public_path(config('img.img_path'));
            $file->move($path, $name);
        }
        DB::transaction(function() use($request, $name) {
            try {
                $course = $this->courseRepo->create($request->all());
                $this->courseRepo->createPolymorphic($course->id , 'image', ['url' => $name]);        
                Alert::success(trans('label.created_success'));
            } catch (Exception $exception) {
                Alert::error(trans('label.created_fail'));
            }
        });

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course->load('lessons');

        return view('admin.component.show_course', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.component.edit_course', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $path = public_path(config('img.img_path'));
            $file->move($path, $name);
            $result = $this->courseRepo->update($course->id, [
                'name' => $request->name,
                'description' => $request->description,
                'img_url' => $name,
            ]);
        } else {
            $result = $this->courseRepo->update($course->id, [
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        if ($result) {
            Alert::success(trans('label.edited_success'));
        } else {
            Alert::error(trans('label.edited_fail'));
        }
        
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $result = $this->courseRepo->delete($course->id);
        if ($result) {
            Alert::success(trans('label.delete_success'));
        } else {
            Alert::error(trans('label.delete_fail'));
        }

        return redirect()->route('courses.index');
    }
}
