<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone',
        'status',
        'date_of_birth',
        'address',
        'github_url',
        'role_id',
        'last_studied_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')->withPivot('status');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user')->withPivot('status')->withTimestamps();
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_user')->withPivot('status', 'submit_url')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function mentorComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function studentRequests()
    {
        return $this->hasMany(Advisor::class, 'student_id');
    }

    public function mentorRequests()
    {
        return $this->hasMany(Advisor::class, 'mentor_id');
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function sendMessages()
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function receiveMessages()
    {
        return $this->hasMany(Message::class, 'to_id');
    }
}
