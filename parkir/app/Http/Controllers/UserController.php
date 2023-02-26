<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('/user-page')->withSuccess('You have logged in');
        } else {
            return redirect('/')->withErrors(['Invalid email or password']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function checkLogin(){
        if(!Auth::user()){
            return redirect()->route('login');
        }
        $getAllUser = null;
        return view('/user-page', compact('getAllUser'));
    }

}

