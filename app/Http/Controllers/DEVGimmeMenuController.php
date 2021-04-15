<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DEVGimmeMenuController extends Controller
{
    public function index(User $user)
    {
        $user = Auth::user();

        return view('gimme', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $user->givePermissionTo($request->give);
        $user->removePermissionTo($request->remove);

        $user->giveRole($request->role);
        $user->removeRole($request->removeRole);

        // return dd($request->permission);
        return back()->with('status', "updated yeah! ... $request->give $request->remove $request->role");
    }
}
