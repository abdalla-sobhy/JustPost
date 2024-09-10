<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all posts from database

        $comments = Comment::all();

        return view('posts.show', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(!auth()->check()) {
        //     return to_route('login');
        // }
        // return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {

        $validated = $request->validate([
            'comment' => ['required', 'min:1'],
        ]);
        $validated['user_id'] = auth()->id();
        $validated['post_id'] = $post->id;
        // dd($post->id);
        // auth()->user()->posts()->create($validated);

        Comment::create($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)// $id
    {
        //or fail gonna throw 404 not found page
        // $post = Post::findOrFail($id);

        //post $post insted of $id and laravel gonna do the previous line by him self

        // return view('posts.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);
        return view('posts.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);
        $validated = $request->validate([
            'comment' => ['required', 'min:1'],
        ]);

        $comment->update($validated);

        return to_route('posts.index', ['comment' => $comment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        return to_route('posts.index');
    }
}
