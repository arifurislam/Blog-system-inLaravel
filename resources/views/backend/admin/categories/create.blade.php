@extends('layouts.admin')

@push('css')

@endpush

@section('title', 'Create Category')
@section('content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Create Category
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Category Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <input type="file" name="image">
                        </div>
                        <a class="btn btn-danger m-t-15 waves-effect"
                            href="{{route('admin.categories.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush
