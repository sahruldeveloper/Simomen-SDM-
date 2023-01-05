<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        // $credentials = $request->validate([
        //     'email' => 'required|email:dns',
        //     'password' => 'required'
        // ]);

        // if (Auth::guard('petinggi')->attemp($credentials)) {
        //     return redirect('/petinggi');
        // } elseif (Auth::guard('user')->attempt($credentials)) {
        //     return redirect('/admin');
        // }


        if (Auth::guard('petinggi')->check()) {
            return redirect('/petinggi/welcome-petinggi');
        } elseif (Auth::guard('staff-admin')->check()) {
            return redirect('/admin');
        }

        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);


        if (Auth::guard('petinggi')->attempt($credentials)) {
            return redirect('/petinggi/welcome-petinggi');
        } elseif (Auth::guard('staff-admin')->attempt($credentials)) {
            return redirect('/admin');
        }

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('/admin');
        // }



        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}