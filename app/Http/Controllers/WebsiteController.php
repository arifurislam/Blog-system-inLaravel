<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $categories = Category::latest()->take(6)->get();
        $posts = Post::where('is_approved',1)->latest()->take(6)->get();
        return view('frontend.home',compact('categories','posts'));
    }
}
