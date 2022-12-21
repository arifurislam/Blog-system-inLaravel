<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Image;
use Storage;
use Auth;
use App\User;

class SettingsController extends Controller
{
    public function index(){
        return view('backend.author.settings.index');
    }

    public function update(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'nullable|email',
            'image' => 'required|image',
        ]);


        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());

        if(isset($image)){
            $imageName = $slug  .'-'.  Carbon::now()->toDateString() . '_'.uniqid().'.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile'))
            {
        		Storage::disk('public')->makeDirectory('profile');
            }
            // delete old image
            if(Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            Image::make($image)->resize(500, 500)->save(base_path('public/storage/profile/'.$imageName));
        }
        else{
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Your profile has been updated', 'Success');
        return redirect()->route('author.settings');
    }

    public function updatepassword(Request $request){

        $this->validate($request,[
            'old' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashpassword=Auth::user()->password;
        if(Hash::check($request->old,$hashpassword)){

            if(!Hash::check($request->password,$hashpassword)){
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::success('Your password has been updated', 'Success');
                Auth::logout();
                return redirect()->back();
            }
            else{
                Toastr::error('Old password and New password can not be same', 'Error');
                return redirect()->back();
            }
        }
        else{
            Toastr::error('Please insert correct password !!!', 'Error');
            return redirect()->back();
        }
    }
}
