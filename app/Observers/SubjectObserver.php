<?php

namespace App\Observers;

use App\Module;
use App\Subject;
use Illuminate\Support\Str;

class SubjectObserver
{
    /**
     * Handle the subject "creating" event.
     *
     * @param  \App\Subject  $subject
     * @return void
     */
    public function creating(Subject $subject)
    {
        $slug = Str::slug($subject->module->name."-".$subject->name);

        $count = Module::query()->where('slug', 'LIKE', "$slug%")->count();
        if ($count) $slug .= "-$count";
        $subject->slug = $slug;
    }

    /**
     * Handle the subject "updated" event.
     *
     * @param  \App\Subject  $subject
     * @return void
     */
    public function updated(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject "deleted" event.
     *
     * @param  \App\Subject  $subject
     * @return void
     */
    public function deleted(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject "restored" event.
     *
     * @param  \App\Subject  $subject
     * @return void
     */
    public function restored(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject "force deleted" event.
     *
     * @param  \App\Subject  $subject
     * @return void
     */
    public function forceDeleted(Subject $subject)
    {
        //
    }
}
