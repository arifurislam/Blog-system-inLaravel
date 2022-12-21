<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('backend.admin.subscriber.index',compact('subscribers'));
    }

    public function destroy($id){
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        Toastr::success('Delete Success', 'Success');
        return redirect()->back();
    }
}
