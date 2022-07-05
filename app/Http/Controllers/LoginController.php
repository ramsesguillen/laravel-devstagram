<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($validated, $request?->remember)) {
            return back()->with('mensaje', 'Creadenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user());
    }
}
