<?php

namespace App\Http\Controllers\Author;

use App\Post;
use App\Tag;
use App\Category;
use App\User;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Image;
use Storage;
use Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('backend.author.posts.index',compact('posts'));
    }

    public function create()
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.author.posts.create',compact('tags','categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image)){
            $imageName = $slug  .'-'.  Carbon::now()->toDateString() . '_'.uniqid().'.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
        		Storage::disk('public')->makeDirectory('post');
            }
            Image::make($image)->resize(1600, 1066)->save(base_path('public/storage/post/'.$imageName));
        }
        else{
            $imageName = "default.png";
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));

        Toastr::success('Post Successfully Created', 'Success');
        return redirect()->route('author.posts.index');
    }

    public function show(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You do not have the permission', 'Error');
            return redirect()->back();
        }
        return view('backend.author.posts.show',compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.author.posts.edit',compact('tags','categories','post'));
    }

    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You do not have the permission', 'Error');
            return redirect()->back();
        }

        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image)){
            $imageName = $slug  .'-'.  Carbon::now()->toDateString() . '_'.uniqid().'.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
        		Storage::disk('public')->makeDirectory('post');
            }
            Image::make($image)->resize(1600, 1066)->save(base_path('public/storage/post/'.$imageName));
        }
        else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Created', 'Success');
        return redirect()->route('author.posts.index');
    }

    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You do not have the permission', 'Error');
            return redirect()->back();
        }
        
        if(Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();
        Toastr::success('Post Successfully deleted', 'Success');
        return redirect()->back();
    }
}
