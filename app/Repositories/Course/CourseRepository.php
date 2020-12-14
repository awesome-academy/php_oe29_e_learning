<?php
namespace App\Repositories\Course;

use App\Repositories\BaseRepository;
use App\Models\Course;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getLatestCourse($relations = [], $number)
    {
        return $this->model->with($relations)->latest('created_at')->take($number)->get();
    }
}
