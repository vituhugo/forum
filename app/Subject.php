<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subject extends Model
{
    protected $fillable = ['title', 'description'];

    public function issues() {
        return $this->hasMany(Issue::class);
    }

    public function last_updated_issue() {
        return $this->hasOne(Issue::class)->orderBy('issues.updated_at');
    }

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function countAnswers() {
        return $this->issues()->join('answers', 'answers.issue_id', 'issues.id')->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
