<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminPostController extends Controller
{
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }



    public function update(Request $request, Post $post)
    {
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

        return to_route('admin', ['post' => $post]);
    }


    public function destroy(Post $post)
    {
        File::delete(storage_path('app/'.$post->thumbnail));
        $post->delete();
        return to_route('admin');
    }
}
