<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 10 characters.',
            'name.unique' => 'This name is already taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 200 characters.'
        ]);
        
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->guard()->login($user);
        return redirect('/');
    }

    public function logout() {
        auth()->guard()->logout('/');
        return redirect('/login');
    }

    public function postLogin(Request $request) {

        $incomingFields = $request->validate([
            'loginname' => ['required'],
            'loginpassword' => ['required']
        ],
        [
            'loginname.required' => 'The name field is required.',
            'loginpassword.required' => 'The password field is required.',
        ] 
    );

    if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
        $request->session()->regenerate();
        return redirect('/');
    } else {
        return redirect()->back()->with('error', 'Login failed. Please check name and password. ');
    }

    }

    public function getLogin(Request $request) {
        return view('/login');
    }
}
