<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $validated = $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|min:3|max:20|unique:users,username',
            'email' => 'required|unique:users,email|email|max:60',
            'password' => 'required|confirmed',
        ]);

        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('posts.index', ['user' => $user]);
    }

}
