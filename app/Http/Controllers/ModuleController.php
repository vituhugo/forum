<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ModuleChangeRequest;
use App\Issue;
use App\Module;
use App\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index() {
        return session('module')
            ? redirect()->route('module.show', [session('module')])
            : view('module.index');
    }

    public function change(ModuleChangeRequest $request) {
        $module = Module::query()->where('slug', $request->module)->firstOrFail();
        session()->put('module', $module);
        return redirect()->route('module.show', [$module]);
    }

    public function show(Module $module) {
        $articles = Article::all();
        session()->put('module', $module);
        return view('module.show', compact('articles'));
    }
}
