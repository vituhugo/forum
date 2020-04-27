<?php

namespace App\Providers;

use App\Answer;
use App\Comment;
use App\Issue;
use App\Module;
use App\Observers\AnswerObserver;
use App\Observers\CommentObserver;
use App\Observers\IssueObserver;
use App\Observers\ModuleObserver;
use App\Observers\SubjectObserver;
use App\Subject;
use App\User;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Issue::observe(IssueObserver::class);
        Module::observe(ModuleObserver::class);
        Subject::observe(SubjectObserver::class);
        Answer::observe(AnswerObserver::class);
        Comment::observe(CommentObserver::class);

        View::share('random_gradient_class', [
            'bg-gradient',
            'bg-gradient-reverse',
            'bg-gradient-soft',
            'bg-gradient-soft-reverse',
        ][random_int(0,3)]);

        View::share('modules', Module::all());

        View::composer('*', function($view) {
            $view->with('module', session('module') ?: new Module());
        });
    }
}
