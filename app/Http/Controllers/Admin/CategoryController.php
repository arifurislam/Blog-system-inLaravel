<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Image;
use Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('backend.admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:60|unique:categories',
            'image' => 'required|mimes:jpeg,png,jpg,bnp',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            $imageName = $slug  .'-'.  Carbon::now()->toDateString() . '_'.uniqid().'.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category'))
            {
        		Storage::disk('public')->makeDirectory('category');
            }
            Image::make($image)->resize(1600, 479)->save(base_path('public/storage/category/'.$imageName));

            if(!Storage::disk('public')->exists('category/slider'))
            {
        		Storage::disk('public')->makeDirectory('category/slider');
            }
            Image::make($image)->resize(500, 333)->save(base_path('public/storage/category/slider/'.$imageName));

        $category =  new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Successfully Created', 'Success');
        return redirect()->route('admin.categories.index');
        }
    }

    public function show(Category $category)
    {
        return view('backend.admin.categories.show',compact('category'));
    }

    public function edit(Category $category)
    {
        return view ('backend.admin.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name' => 'string|max:60',
            'image' => 'mimes:jpeg,png,jpg,bnp',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            $imageName = $slug  .'-'.  Carbon::now()->toDateString() . '_'.uniqid().'.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category'))
            {
        		Storage::disk('public')->makeDirectory('category');
            }
            
            if(Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }
            Image::make($image)->resize(1600, 479)->save(base_path('public/storage/category/'.$imageName));

            if(!Storage::disk('public')->exists('category/slider'))
            {
        		Storage::disk('public')->makeDirectory('category/slider');
            }
            if(Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }
            Image::make($image)->resize(500, 333)->save(base_path('public/storage/category/slider/'.$imageName));
        }
        else{
            $imageName = $category->image;
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Successfully Updated', 'Success');
        return redirect()->route('admin.categories.index');

    }

    public function destroy(Category $category)
    {

        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }

        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();
        Toastr::success('Category Successfully deleted', 'Success');
        return redirect()->back();
    }
}
