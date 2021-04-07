<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']); // Redirect to home if not guest
    }

    public function index()
    {
        return view('auth.login');
    }
}
