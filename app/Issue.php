<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Issue extends Model
{
    protected $fillable = ['title', 'content', 'subject_id'];

    public function attachments() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function last_user_updated() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function answer_approve() {
        return $this->hasOne(Answer::class, 'approve_answer_id');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function followers() {
        return $this->belongsToMany(User::class)->wherePivot('type', config('data.issue_user_types.follow'));
    }

    public function favorited() {
        return $this->belongsToMany(User::class)->wherePivot('type', config('data.issue_user_types.favorite'));
    }

    public function likes() {
        return $this->belongsToMany(User::class)->wherePivot('type', config('data.issue_user_types.like'));
    }

    public function unlikes() {
        return $this->belongsToMany(User::class)->wherePivot('type', config('data.issue_user_types.unlikes'));
    }

    public function votes() {
        return $this->belongsToMany(User::class)
            ->where('issue_user.type', config('data.issue_user_types.like'))
            ->orWhere('issue_user.type', config('data.issue_user_types.unlike'));
    }

    public function incrementView() {
        $this->timestamps = false;
        $this->views++;
        $this->save();
        $this->timestamps = true;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
