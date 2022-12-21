<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function search(Request $request){

        $query = $request->input('search');
        $posts = Post::where('title','LIKE',"%$query%")->where('is_approved',1)->get();
        return view('frontend.search',compact('posts','query'));
    }
}
