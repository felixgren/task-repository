<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

class UserSettingController extends Controller
{
    public function index(User $user)
    {
        $user = Auth::user();

        return view('user.settings', [
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->save();

        return redirect()->route('users.profile', [
            'user' => $user,
        ])->with('status', 'Profile successfully updated!');
    }
}
