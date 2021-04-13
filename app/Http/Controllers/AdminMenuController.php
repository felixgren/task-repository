<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminMenuController extends Controller
{
    public function index(User $user)
    {
        $user = Auth::user();

        return view('user.admin', [
            'user' => $user,
        ]);
    }

    public function update()
    {
        return 'im so empty';
    }
}
