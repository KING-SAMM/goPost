<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    //Now I can do "Post $post" below since I did '/posts/{post}/likes' in my routes. (i.e in web.php)
    public function store(Post $post, Request $request)
    {
        /**
         * Check if user has already liked post
        */
        if($post->likedBy($request->user()))
        {
            return response(null. "You already liked this post");
        }


        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
