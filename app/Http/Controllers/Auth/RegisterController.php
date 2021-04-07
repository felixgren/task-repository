<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:26',
            'username' => 'required|max:20|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ];

        $customMessages = [
            'name.required' => 'You need a :attribute',
            'username.required' => 'Enter a :attribute',
            'email.required' => 'Enter your :attribute',
            'password.required' => 'Enter a :attribute',
            'confirmed' => 'The passwords do not match.',
        ];

        $this->validate($request, $rules, $customMessages);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash facade 
        ]);

        Auth::attempt($request->only('email', 'password'));

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
