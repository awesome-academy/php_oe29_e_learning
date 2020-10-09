<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
