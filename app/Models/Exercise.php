<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'submit_url',
        'lesson_id',
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'exercise_user');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
