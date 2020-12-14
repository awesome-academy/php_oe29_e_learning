<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Course\CourseRepositoryInterface::class,
            \App\Repositories\Course\CourseRepository::class, 
        );
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Message\MessageRepositoryInterface::class,
            \App\Repositories\Message\MessageRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Advisor\AdvisorRepositoryInterface::class,
            \App\Repositories\Advisor\AdvisorRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['user.component.index', 'user.component.lesson_detail', 'user.component.course', 'user.component.lessons', 'user.component.mentor'], 'App\Http\View\Composers\AdvisorComposer'
        );
        View::composer(
            ['layouts.message'], 'App\Http\View\Composers\RequestComposer'
        );
    }
}
