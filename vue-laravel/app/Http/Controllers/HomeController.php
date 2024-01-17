<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        if($request->category){
            $posts = PostResource::collection(Category::where('name', $request->category)->firstOrFail()->posts()->latest()->paginate(1)->withQueryString());
        }else if($request->search){
            $posts = PostResource::collection(Post::where('title', 'like', '%'.$request->search . '%')
                ->orWhere('body', 'like', '%'.$request->search. '%')->latest()->paginate(1)->withQueryString());
        }
        else{
            $posts= PostResource::collection(Post::latest()->paginate());
        }
        return $posts;
    }

    public function relatedPost(Post $post){
        $category = $post->category;
        $relatedPosts = $category->posts()->where('id', '!=', $post->id)->take(3)->get();        
        return response()->json([
            'data' => $relatedPosts
        ]);
    }
}
