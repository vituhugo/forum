<?php

namespace App\Http\Controllers;

use App\Module;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show(Module $module, Subject $subject) {
        $modules = Module::all();
        return view('subject.show', compact('module', 'subject', 'modules'));
    }
}
