<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:255'
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['post_id'] = $post->id;

        Comentario::create($validated);

        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
