<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request) // Sign user in
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $customMessages = [
            'email.required' => 'Enter your :attribute',
            'password.required' => 'Enter your :attribute',
        ];

        $this->validate($request, $rules, $customMessages);

        $credentials = $request->only('email', 'password');
        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('status', 'Sorry, try again');
    }
}
