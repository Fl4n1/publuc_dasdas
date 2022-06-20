<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:post-list', ['only' => ['admin']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%')->latest()->paginate(15);
        } else {
            $posts = Post::latest()->paginate(15);
        }

        return view('blog.index', compact('posts'));
    }

    public function admin(Request $request)
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required',
        ]);

        $title = $request->input('title');

        if (Post::latest()->first() !== null) {
            $postId = Post::latest()->first()->id + 1;
        } else {
            $postId = 1;
        }

        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = Auth::user()->id;
        $body = $request->input('body');

        //File upload
        $imagePrevPath = 'storage/' . $request->file('img_prev')->store('preview', 'public');
        $imagePath = 'storage/' . $request->file('image')->store('posts', 'public');

        $post = new Post();
        $post->title = $title;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->img_prev = $imagePrevPath;
        $post->image = $imagePath;

        $post->save();

        return to_route('admin.news.index')
            ->with('success', 'Пост был успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('blog.show')
            ->with('post', Post::where('id', $post->id)->first());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $title = $request->input('title');

        $postId = $post->id;
        $slug = Str::slug($title, '-') . '-' . $postId;
        $body = $request->input('body');

        //File upload
        $post->title = $title;
        $post->slug = $slug;
        $post->body = $body;

        if (!isEmpty($request->file('image'))) {
            $imagePath = 'storage/' . $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        if (!isEmpty($request->file('img_prev'))) {
            $imagePrevPath = 'storage/' . $request->file('img_prev')->store('preview', 'public');
            $post->img_prev = $imagePrevPath;
        }


        $post->save();

        return to_route('admin.news.index')
            ->with('status', 'Пост был успешно изменён!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Пост был успешно удалён!');
    }
}
