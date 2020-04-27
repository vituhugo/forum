<?php

namespace App;

use App\Observers\ModuleObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    protected $fillable = ['name'];

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function issues() {
        return $this->hasMany(Subject::class)->join('issues', 'subjects.id', 'subject_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
