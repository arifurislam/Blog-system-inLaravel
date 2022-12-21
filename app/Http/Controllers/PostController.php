<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    
    public function index(){
        $posts = Post::where('is_approved',1)->latest()->paginate(6);
        return view('frontend.posts',compact('posts'));
    }

    public function details($slug){
        $post = Post::where('slug', $slug)->firstOrFail();

        $bogkey = 'blog_'.$post->id;

        if(!Session::has($bogkey)){
            $post->increment('view_count');
            Session::put($bogkey,1);
        }

        $randomposts = Post::all()->random(3);
        return view('frontend.details',compact('post','randomposts'));
    }

    public function postsByCategory($slug){
        $category = Category::where('slug',$slug)->first();
        return view('frontend.category',compact('category'));
    }

    public function postsByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        return view('frontend.tags',compact('tag'));
    }

    
}
