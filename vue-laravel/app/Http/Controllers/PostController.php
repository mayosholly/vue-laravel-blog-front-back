<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Str;

class PostController extends Controller
{
    public function index(){
        $post = Post::with('category')->get();
        return response()->json([
            'status' => true,
            'data' => $post,
            'message' => "All Posts"
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'file' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        $title = $request->title;
        $category_id = $request->category_id;
        if(!Post::count()){
            $postId = 1;
        } else{
            $postId = Post::latest()->first()->id + 1;
        }
        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = auth()->user()->id;
        $body = $request->body;
        $imagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');

        $post= new Post();
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->imagePath = $imagePath;
        $post->save();

        return response()->json([
            'status' => true,
            'data' => $post,
            'message' => 'Successfully Created'
        ]);
    }

    public function show(Post $post){
        return response()->json([
            'status' => true,
            'data' => new PostResource($post),
            'message' => 'Single post'
        ]);
    }

    public function update(Request $request, Post $post){
        $request->validate([
            'title' => 'required',
            'file' => 'nullable | image',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        $title = $request->title;
        $category_id = $request->category_id;
        if($request->title){
            $slug = Str::slug($title, '-') . '-' . $post->id;
            $post->slug = $slug;

        }
        $body = $request->body;

        if($request->file('file')){
            File::delete($post->imagePath);
            $imagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');
            $post->imagePath = $imagePath;
        }

        $post->title = $title;
        $post->category_id = $category_id;
        $post->body = $body;
        $post->save();

        return response()->json([
            'status' => true,
            'data' => $post,
            'message' => 'Successfully Updated'
        ]);
    }

    public function destroy(Post $post){
        File::delete($post->imagePath);
        $post->delete();
        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Successfully Deleted'
        ]);
    }

}
