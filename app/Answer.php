<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['content'];

    protected $touches = ['issue'];

    public function issue() {
        return $this->belongsTo(Issue::class);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
