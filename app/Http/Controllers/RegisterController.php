<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:5|max:13',
        ]);


        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil, Silakan Login');

        return redirect('/login')->with('success', 'Registrasi Berhasil, Silakan Login');
    }
}