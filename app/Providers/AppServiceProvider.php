<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
            \App\Repositories\Course\CourseRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Topic\TopicRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Lesson\LessonRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Word\WordRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
