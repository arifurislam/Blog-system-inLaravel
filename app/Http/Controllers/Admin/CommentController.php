<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Comment;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('backend.admin.comment.index',compact('comments'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Toastr::success('Delete Success', 'Success');
        return redirect()->back();
    }

}
