<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function profile($username){
        $author = User::where('username',$username)->first();
        $posts = $author->posts()->where('is_approved',1)->get();
        return view('frontend.profile',compact('author','posts'));
    }
}
