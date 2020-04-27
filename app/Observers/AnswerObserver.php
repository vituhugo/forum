<?php

namespace App\Observers;

use App\Answer;

class AnswerObserver
{
    /**
     * Handle the answer "created" event.
     *
     * @param  \App\Answer  $answer
     * @return void
     */
    public function created(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "updated" event.
     *
     * @param  \App\Answer  $answer
     * @return void
     */
    public function updated(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "deleted" event.
     *
     * @param  \App\Answer  $answer
     * @return void
     */
    public function deleted(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "restored" event.
     *
     * @param  \App\Answer  $answer
     * @return void
     */
    public function restored(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "force deleted" event.
     *
     * @param  \App\Answer  $answer
     * @return void
     */
    public function forceDeleted(Answer $answer)
    {
        //
    }
}
