<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function show(User $user) {
        return view('profile.show', compact('user'));
    }

    public function edit() {
        return view('profile.edit');
    }

    public function update(UserUpdateRequest $request) {
        $user = Auth::user();
        $user->fill($request->validated());

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
    }

    public function password() {
        return view('profile.password_change');
    }

    public function changePassword(UserChangePasswordRequest $request) {
        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with('success', 'Senha alterada com sucesso!');
    }

    public function favorite() {
        $issues = \auth()->user()->favorite->loadCount('answers');
        return view('profile.favorite', compact('issues'));
    }

    public function history() {
        return view('profile.history');
    }

    public function open() {
        $issues = \auth()->user()->open_issues;
        return view('profile.open', compact('issues'));
    }

    public function close() {
        $issues = \auth()->user()->approve_issues;
        return view('profile.close', compact('issues'));
    }
}
