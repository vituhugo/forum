<?php

namespace App\Observers;

use App\Issue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IssueObserver
{
    /**
     * Handle the issue "creating" event.
     *
     * @param  \App\Issue  $issue
     * @return void
     */
    public function creating(Issue $issue)
    {
        $issue->updated_by = $issue->user_id;
        $slug = Str::slug($issue->title);
        $count = Issue::query()->where('slug', 'LIKE', "$slug%")->count();
        if ($count) $slug .= "-$count";
        $issue->slug = $slug;
    }

    /**
     * Handle the issue "updated" event.
     *
     * @param  \App\Issue  $issue
     * @return void
     */
    public function updating(Issue $issue)
    {
        if ($issue->timestamps) $issue->updated_by = auth()->user()->id;
    }

    /**
     * Handle the issue "deleted" event.
     *
     * @param  \App\Issue  $issue
     * @return void
     */
    public function deleted(Issue $issue)
    {
        //
    }

    /**
     * Handle the issue "restored" event.
     *
     * @param  \App\Issue  $issue
     * @return void
     */
    public function restored(Issue $issue)
    {
        //
    }

    /**
     * Handle the issue "force deleted" event.
     *
     * @param  \App\Issue  $issue
     * @return void
     */
    public function forceDeleted(Issue $issue)
    {
        //
    }
}
