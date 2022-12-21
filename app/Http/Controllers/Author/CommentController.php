<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Comment;
use Auth;

class CommentController extends Controller
{

    public function index(){
        $posts = Auth::user()->posts;
        return view('backend.author.comment.index',compact('posts'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        if($comment->user->id == Auth::id()){

            $comment->delete();
            Toastr::success('Delete Success', 'Success');
        }
        else
        {
            Toastr::success('Access denied !', 'Success');
        }

        return redirect()->back();
    }

}
