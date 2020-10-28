<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'course_id',
        'course_order',
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_user');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
