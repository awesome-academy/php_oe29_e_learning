<?php
namespace App\Repositories\Course;

interface CourseRepositoryInterface
{
    public function getLatestCourse($relation = [], $number);
}
