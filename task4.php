<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Case4 extends Controller
{
    public function createPost(Request $request){
        $title = $request->input('title');

        $existingPosts = BlogPost::where('title', $title)->get();

        foreach($existingPosts as $existing_post){
            if($existing_post->title == $title){
                return "Title already exists.";
            }
        }

        $post = new BlogPost;
        $post->title = $title;

        $post->status = 'published';
        $post->save();

        $categoryId = $request->input("categoryId");
        DB::table('post_categories')->insert([
            'post_id' => $post->id,
            'category_id' => $categoryId
        ]);

        return "Post created successfully!";
    }
}
