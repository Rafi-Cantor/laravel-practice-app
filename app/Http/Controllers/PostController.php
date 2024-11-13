<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }

    public function showEditPost(Post $post) {
        return view('/edit-post', ['post' => $post]);
    }

    public function editPost(Post $post, Request $request ) {
        $incomingFields = $request->validate([
            'title' => 'sometimes|required_without:body',
            'body' => 'sometimes|required_without:title',
        ]);
        
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return redirect('/');
    }

    public function deletePost(Post $post) {
        $post->delete();
        return redirect('/');
    }

}
