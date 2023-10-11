<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register user form
    public function create()
    {
        return view('users.register');
    }

    // show login user form
    public function login()
    {
        return view('users.login');
    }

    // store new user
    public function store(Request $request)
    {
        // validate form fields
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8'
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create the user
        $user = User::create($formFields);

        // login the user
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in!');
    }

    // logout user
    public function logout(Request $request)
    {
        // remove auth user session
        auth()->logout();

        // invalidate session
        $request->session()->invalidate();

        // regenerate csrf token
        $request->session()->regenerateToken();

        // redirect to home page
        return redirect('/')->with('message', 'You have been logged out!');
    }

    // login user
    public function authenticate(Request $request)
    {
        // validate form fields
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // attempt to login user
        if (auth()->attempt($formFields)) {
            // regenerate session id
            $request->session()->regenerate();

            // redirect to home page
            return redirect('/')->with('message', 'You are now logged in!');
        } else {
            // redirect back to login page
            return redirect('/login')->withErrors(
                [
                    'email' => 'Invalid Credentials'
                ]
            )->onlyInput('email');
        }
    }
}