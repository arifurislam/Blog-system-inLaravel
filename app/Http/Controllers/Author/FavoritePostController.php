<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FavoritePostController extends Controller
{
    public function index(){
        $posts = Auth::user()->favorite_posts;
        return view('backend.author.favorite.index',compact('posts'));
    }
}
