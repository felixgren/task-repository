<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        $user = Auth::user(); // this will be any user later
        return view('user.profile', [
            'user' => $user,
        ]);
    }
}
