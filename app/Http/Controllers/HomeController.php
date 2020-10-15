<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where([
            (Auth::user()->admin)? '' : 'user_id' => Auth::user()->id
        ])->get();
        foreach ($posts as $post) {
            $post['author'] = User::find($post->user_id)->get()->first()->name;
        }
        return view('home', compact('posts'));
    }

    public function newPost(Request $request)
    {
        $request->validate([
            'judul-baru' => 'required',
            'isi-baru' => 'required'
        ]);

        Post::create([
            'title' => request()['judul-baru'],
            'value' => request()['isi-baru'],
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('home'));
    }

    public function publish(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'publish'=> 'required'
        ]);
        if (Auth::user()->admin) {
            $post = Post::find(request()->id);
            if ($post) {
                $post->update([
                    'published' => boolval(request()->publish)
                    ]);
            }
        }
        return redirect(route('home'));
    }
}
