<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request,$post){

        $this->validate($request,[
            'comment' => 'required'
        ]);
        
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $request->comment;
        $comment->save();

        Toastr::success('Comment Added successfull', 'Success');
        return redirect()->back();
    }
}
