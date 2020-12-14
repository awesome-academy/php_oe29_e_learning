<?php
namespace App\Repositories\Advisor;

use App\Repositories\BaseRepository;
use App\Models\Advisor;

class AdvisorRepository extends BaseRepository implements AdvisorRepositoryInterface
{
    public function getModel()
    {
        return Advisor::class;
    }

    public function getMessageSendFromMentor($id)
    {
        return $this->model->with(['mentor.sendMessages' => function($query) use($id) {
            $query->where('to_id', $id)->latest();
        }])->whereNotNull('mentor_id')
            ->where('student_id', $id)
            ->select('mentor_id')
            ->groupBy('mentor_id')
            ->get();
    }

    public function getMessageSendFromStudent($id)
    {
        return $this->model->with(['student.sendMessages' => function($query) use($id) {
            $query->where('to_id', $id)->latest();
        }])->where('mentor_id', $id)
            ->select('student_id')
            ->groupBy('student_id')
            ->get();
    }
}
