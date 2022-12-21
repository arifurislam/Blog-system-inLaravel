<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Auth;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(){
        $posts = Post::all();
       $popular_post = Post::withCount('comments')
                                ->withCount('favorite_to_users')
                                ->orderBy('view_count','desc')
                                ->orderBy('comments_count','desc')
                                ->orderBy('favorite_to_users_count','desc')
                                ->take(5)->get();
        $pending_posts = Post::where('is_approved',0)->count();
        $all_view = Post::sum('view_count');
        $authors = User::authors()->count();
        $author_today = User::authors()
                        ->whereDate('created_at',Carbon::today())->count();
        $active_authors = User::authors()
                          ->withCount('posts')
                          ->withCount('comments')
                          ->withCount('favorite_posts')
                          ->orderBy('posts_count','desc')
                          ->orderBy('comments_count','desc')
                          ->orderBy('favorite_posts_count','desc')
                          ->take(10)->get();
        $categories = Category::all()->count();
        $tags = Tag::all()->count();
        return view('backend.admin.dashboard.index',compact('posts','popular_post','pending_posts',
    'all_view','authors','author_today','active_authors','categories','tags'));
    }
}
