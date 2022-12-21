<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->get();
        return view('backend.admin.tags.index',compact('tags'));
    }

    public function create()
    {
        return view('backend.admin.tags.create');
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request,[
            'name' => 'required|string|max:60|unique:tags,name,'
        ]);

        // store
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();
        Toastr::success('Tag Successfully Created', 'Success');
        return redirect()->route('admin.tags.index');
    }

    public function show(Tag $tag)
    {
        return view('backend.admin.tags.show',compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('backend.admin.tags.edit',compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        // validation
        $this->validate($request,[
            'name' => 'required|string|max:60|unique:tags,name,'.$tag->id
        ]);

        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();
        Toastr::success('Tag Successfully Updated', 'Success');
        return redirect()->route('admin.tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        Toastr::success('Tag Successfully deleted', 'Success');
        return redirect()->back();
    }
}
