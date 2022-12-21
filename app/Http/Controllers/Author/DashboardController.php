<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();
        $posts = $user->posts;
        $popular_post = $user->posts()
        ->withCount('comments')
        ->withCount('favorite_to_users')
        ->orderBy('view_count','desc')
        ->orderBy('comments_count')
        ->orderBy('favorite_to_users_count')
        ->take(5)->get();
        $total_pending_posts = $posts->where('is_approved',0)->count();
        $all_views = $posts->sum('view_count');

        return view('backend.author.dashboard.index',compact('posts','popular_post','total_pending_posts','all_views'));
    }
}
