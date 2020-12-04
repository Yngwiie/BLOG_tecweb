<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $last_posts = Post::latest()->take(3)->orderBy('id','DESC')->get();
        
        $cantidad_posts = Post::orderBy('id','DESC')->count();
        $cantidad = $cantidad_posts - 3;
        $posts = Post::orderBy('id','DESC')->paginate(4);
      
        return view('noticias.index',['posts' => $posts,'last_posts' => $last_posts]);
    }

    public function show($id)
    {

        $post = Post::findOrFail($id);
        $post->visitas = $post->visitas + 1;
        $post->save();
        return view('noticias.show',['post' => $post]);
    }
}
