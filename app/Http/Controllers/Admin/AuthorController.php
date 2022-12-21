<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Storage;
use App\User;

class AuthorController extends Controller
{
    public function index(){
       $authors = User::authors()
       ->withCount('posts')
       ->withCount('comments')
       ->withCount('favorite_posts')
       ->get();
       return view('backend.admin.authors.index',compact('authors'));
    }
    
    public function destroy($id){
        $comment = User::findOrFail($id);
        if(Storage::disk('public')->exists('profile/'.$comment->image))
        {
            Storage::disk('public')->delete('profile/'.$comment->image);
        }
        $comment->delete();
        Toastr::success('Delete Success', 'Success');
        return redirect()->back();
    }
}
