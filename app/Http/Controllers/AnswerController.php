<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Http\Requests\AnswerDestroyRequest;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\AnswerUpdateRequest;
use App\Http\Requests\IssueCommentRequest;
use App\Issue;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param AnswerStoreRequest $request
     * @param Issue $issue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AnswerStoreRequest $request, Issue $issue)
    {
        $answer = Answer::make($request->validated());
        $answer->user_id = auth()->user()->id;

        $issue->answers()->save($answer);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Issue $issue
     * @param \App\Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AnswerUpdateRequest $request, Issue $issue, Answer $answer)
    {
        $answer->fill($request->validated())->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(AnswerDestroyRequest $answer)
    {
        $answer->delete();
        return redirect()->back();
    }


    public function comment(IssueCommentRequest $request, Issue $issue, Answer $answer) {
        $answer->comments()->create($request->validated());
        return redirect()->back();
    }

    public function commentDestroy(Issue $issue, Answer $answer, Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
