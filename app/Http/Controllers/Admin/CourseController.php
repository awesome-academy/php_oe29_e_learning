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
        $data = $request->all();
        if ($data['photo']) {
            $file = $data['photo'];
            $name = time() . $file->getClientOriginalName();
            $path = public_path(config('img.img_path'));
            $file->move($path, $name);
        }
        try {
            $course = $this->courseRepo->create($data);
            $this->courseRepo->createPolymorphic($course->id , 'image', ['url' => $name]);        
            Alert::success(trans('label.created_success'));
        } catch (Exception $exception) {
            Alert::error(trans('label.created_fail'));
        }

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->courseRepo->loadRelations($id, ['lessons']);

        return view('admin.component.show_course', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->courseRepo->find($id);
        return view('admin.component.edit_course', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $data = $request->all();
        if ($request->photo) {
            $file = $data['photo'];
            $name = time() . $file->getClientOriginalName();
            $path = public_path(config('img.img_path'));
            $file->move($path, $name);
            $result = $this->courseRepo->update($id, [
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
            $this->courseRepo->updatePolymorphic($id , 'image', ['url' => $name]);
        } else {
            $result = $this->courseRepo->update($id, [
                'name' => $data['name'],
                'description' => $data['description'],
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
    public function destroy($id)
    {
        $result = $this->courseRepo->delete($id);
        if ($result) {
            Alert::success(trans('label.delete_success'));
        } else {
            Alert::error(trans('label.delete_fail'));
        }

        return redirect()->route('courses.index');
    }
}
