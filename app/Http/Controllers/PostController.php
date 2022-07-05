<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }


    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(20);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        // $validated['user_id'] = auth()->user()->id;
        // Post::create($validated);

        $request->user()->posts()->create($validated);

        return redirect()->route('posts.index', auth()->user());
    }

    public function show(User $user, Post $post)
    {
        // $postWithComments = $post->load('comentarios.user');
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // delete image
        $imagen_path = public_path('uploads/'.$post->imagen);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
            // File::delete();
        }

        return redirect()->route('posts.index', auth()->user());
    }
}
