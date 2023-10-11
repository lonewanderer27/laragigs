<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register user
    public function create() {
        return view('users.register');
    }

    // store new user
    public function store(Request $request) {
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
}
