<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class FavoriteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function add($post){
        
        $user = Auth::user();
        $isfavorite = $user->favorite_posts()->where('post_id',$post)->count();

        if($isfavorite == 0){
            $user->favorite_posts()->attach($post);
            Toastr::success('This post is added in your favorite list', 'Success');
            return redirect()->back();
        }
        else {
            $user->favorite_posts()->detach($post);
            Toastr::success('This post is removed from your favorite list', 'Success');
            return redirect()->back();
        }
    }
}
