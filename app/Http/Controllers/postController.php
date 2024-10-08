<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Symfony\Contracts\Service\Attribute\Required;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all posts from database

        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->check()) {
            return to_route('login');
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['image'],
        ]);
        if($request->has('thumbnail')){
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnail');
        }
        $validated['user_id'] = auth()->id();
        // auth()->user()->posts()->create($validated);

        Post::create($validated);

        Mail::to(auth()->user()->email)->send(new PostMail(['title' => $validated['title'], 'content' => $validated['content']]));

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)// $id
    {
        //or fail gonna throw 404 not found page
        // $post = Post::findOrFail($id);

        //post $post insted of $id and laravel gonna do the previous line by him self

        // $comments =  Comment::where('post_id', $post->id)->get();

        // $commentUserName = User::where('id', $comments->user_id)->get();


        // $post->load("comments");
        // get all the comments published by  the user 2
        // dd($post->comments()->where("comments.user_id", 2)->get()->toArray());
        // get all the comments
        // dd($post->comments);
        // the line above is the same as this
        // dd($post->comments()->get()->toArray());
        // only get the comments made by the authenticated user
        // dd($post->comments()->where("comments.user_id", auth()->user()->id)->get()->toArray());
        $post->load(["comments", "comments.user"]);

        return view('posts.show', ['post' => $post, 'comments' => $post->comments, 'commentUserName' => "$\commentUserName"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['sometimes', 'image'],
        ]);

        if($request->hasFile('thumbnail')){
            File::delete(storage_path('app/'.$post->thumbnail));
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnail');
        }

        $post->update($validated);

        return to_route('posts.index', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        File::delete(storage_path('app/'.$post->thumbnail));
        $post->delete();
        return to_route('posts.index');
    }
}
