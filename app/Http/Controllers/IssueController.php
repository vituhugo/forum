<?php

namespace App\Http\Controllers;

use App\Comment;
use App\File;
use App\Http\Requests\IssueCommentRequest;
use App\Http\Requests\IssueCreateRequest;
use App\Http\Requests\IssueUpdateRequest;
use App\Issue;
use App\Module;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $modules = Module::all();
        return view('module.index', compact('modules', 'module_active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $modules = Module::all();
        return view('issue.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IssueCreateRequest $request)
    {
        $issue = Issue::make($request->validated());
        $issue->user_id = Auth::user()->id;
        $issue->save();

        $attachments = [];
        foreach($request->file('attachments') ?: [] as $attachment) {
            $file = File::makeFromUploadFile($attachment, 'issues_attachments');
            $file->save();
            $attachments[] = $file;
        }

        $issue->attachments()->saveMany($attachments);

        return redirect()->action('IssueController@show', [$issue]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Issue $issue)
    {
        if (!$request->cookie('viewed_'.$issue->id)) $issue->incrementView();

        $issue->loadCount('answers');

        return response(view('issue.show', compact('issue')))->cookie('viewed_' .$issue->id, true, 0);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Issue $issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Issue $issue)
    {
        $modules = Module::all();
        return view('issue.edit', compact('modules', 'issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IssueUpdateRequest  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IssueUpdateRequest $request, Issue $issue)
    {
        $issue->fill($request->validated());
        $issue->save();

        $attachments = File::query()->findMany($request->old_attachments ?? []);

        foreach($request->file('attachments') ?: [] as $attachment) {
            $file = File::makeFromUploadFile($attachment, 'issues_attachments');
            $file->save();
            $attachments[] = $file;
        }

        $issue->attachments()->saveMany($attachments);
        $issue->attachments()
            ->whereNotIn('id', $attachments->pluck('id'))
            ->get()
            ->each(function(File $file) { $file->delete(); });

        return redirect()->action('IssueController@show', [$issue]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }

    public function follow(Issue $issue)
    {
        $issue->followers()->toggle([\auth()->user()->id => ['type' => config('data.issue_user_types.follow')]]);
        return redirect()->back();
    }

    public function favorite(Issue $issue)
    {
        $issue->favorited()->toggle([\auth()->user()->id => ['type' => config('data.issue_user_types.favorite')]]);
        return redirect()->back();
    }

    public function like(Issue $issue)
    {
        if ($issue->votes()->find(\auth()->user()->id)) return redirect()->back()->with('error', 'Essa ação não é possível');
        $issue->votes()->attach([\auth()->user()->id => ['type' => config('data.issue_user_types.like')]]);

        $issue->points += 1;
        $issue->save();

        return redirect()->back();
    }

    public function unlike(Issue $issue)
    {
        if ($issue->votes()->find(\auth()->user()->id)) return redirect()->back()->with('error', 'Essa ação não é possível');
        $issue->votes()->attach([\auth()->user()->id => ['type' => config('data.issue_user_types.unlikes')]]);

        $issue->points -= 1;
        $issue->save();

        return redirect()->back();
    }

    public function comment(IssueCommentRequest $request, Issue $issue) {
        $issue->comments()->create($request->validated());
        return redirect()->back();
    }

    public function commentDestroy(Issue $issue, Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
