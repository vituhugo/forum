<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function issues() {
        return $this->hasMany(Issue::class);
    }

    public function open_issues() {
        return $this->hasMany(Issue::class)->whereNull('approve_answer_id');
    }

    public function approve_issues() {
        return $this->hasMany(Issue::class)->whereNotNull('approve_answer_id');
    }

    public function awards() {
        return $this->belongsToMany(Award::class);
    }

    public function follows() {
        return $this->belongsToMany(Issue::class)->wherePivot('type', config('data.issue_user_types.follow'));
    }

    public function favorite() {
        return $this->belongsToMany(Issue::class)->wherePivot('type', config('data.issue_user_types.favorite'));
    }

    public function likes() {
        return $this->belongsToMany(Issue::class)->wherePivot('type', config('data.issue_user_types.like'));
    }

    public function unlikes() {
        return $this->belongsToMany(Issue::class)->wherePivot('type', config('data.issue_user_types.unlikes'));
    }

    public function votes() {
        return $this->belongsToMany(Issue::class)
            ->where('issue_user.type', config('data.issue_user_types.like'))
            ->orWhere('issue_user.type', config('data.issue_user_types.unlike'));
    }

    public function wasVoted($issue) {
        return !!$this->votes()->find($issue->id);
    }

    public function setPasswordAttribute($value) {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarUrlAttribute() {
        return Storage::disk('public')->url($this->attributes['avatar']);
    }

    public function isFollower($issue) {
        return !!$this->follows()->find($issue->id);
    }

    public function isFavorite($issue) {
        return !!$this->favorite()->find($issue->id);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
