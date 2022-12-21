@extends('layouts.admin')

@push('css')

@endpush

@section('title', 'Edit Category')
@section('content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Category
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                <label class="form-label">Tag Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="file" name="image">
                            </div>
                            <img class="thumb-edit" src="{{asset('storage/category/slider/'.$category->image)}}"
                            alt="category{{$category->id}}">
                        </div>

                        <a class="btn btn-danger m-t-15 waves-effect"
                        href="{{route('admin.categories.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush
