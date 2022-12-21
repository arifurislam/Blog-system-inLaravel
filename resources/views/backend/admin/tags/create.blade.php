@extends('layouts.admin')

@push('css')

@endpush

@section('title', 'Create Tag')
@section('content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Create Tag
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.tags.store')}}" method="post">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Tag Name</label>
                            </div>
                        </div>
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.tags.index')}}">Back</a>
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
