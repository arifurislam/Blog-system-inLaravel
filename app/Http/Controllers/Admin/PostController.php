<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use App\Category;
use App\Subscriber;
use App\Notifications\NewPostNotification;
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
        $posts = Post::latest()->get();
        return view('backend.admin.posts.index',compact('posts'));
    }

    public function create()
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.admin.posts.create',compact('tags','categories'));
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber){
            Notification::route('mail', $subscriber->email)
                ->notify(new NewPostNotification($post));
        }

        Toastr::success('Post Successfully Created', 'Success');
        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        return view('backend.admin.posts.show',compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.admin.posts.edit',compact('tags','categories','post'));
    }

    public function update(Request $request, Post $post)
    {
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
            // delete old image
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Your post has been successfully updated', 'Success');
        return redirect()->back();
    }
    public function pending(){
        $posts = Post::where('is_approved',false)->get();
        return view('backend.admin.posts.pending',compact('posts'));
    }
    
    public function approve($id){
        $post = Post::find($id);
        if($post->is_approved == false){
            $post->is_approved = true;
            $post->save();
            $post->user->notify(new AuthorPostAprove($post));
            Toastr::success('Your post is approved', 'Success');
            return redirect()->back();
        }
    }

    public function destroy(Post $post)
    {
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
