<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{

    public function login(){
        return view('auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'string'],
        ]);

        // attempt to log the user in

        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('views.welcome'));
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records',
            ]);
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('views.welcome');
    }


}
