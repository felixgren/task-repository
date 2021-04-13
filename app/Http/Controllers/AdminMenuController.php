<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminMenuController extends Controller
{
    public function index(User $user)
    {
        $adminUser = Auth::user();
        // $users = DB::table('users')->get()->sortBy('created_at');
        $users = User::with(['assignments', 'roles', 'permissions'])->get()->sortBy('created_at');

        // $assignments = Assignment::with(['user'])->orderByDesc('created_at')->paginate(15);

        return view('user.admin', [
            'adminUser' => $adminUser,
            'users' => $users,
            // 'assignments' => $assignments,
        ]);
    }

    public function update()
    {
        return 'im so empty';
    }
}
