@extends('layouts.admin')

@section('title', 'Singel Tag')
@section('content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="block-header ml-4">
            <a class="btn btn-danger waves-effect" href="{{route('admin.tags.index')}}">
                <i class="material-icons">fast_rewind</i>
                <span>Back</span>
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Read Singel Tag
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered-show">
                        <tr>
                            <td># ID</td>
                            <td class="text-center">:</td>
                            <td>{{$tag->id}}</td>
                        </tr>
                        <tr>
                            <td>Tag Name</td>
                            <td class="text-center">:</td>
                            <td>{{$tag->name}}</td>
                        </tr>
                        <tr>
                            <td>Create Time</td>
                            <td class="text-center">:</td>
                            <td>{{$tag->created_at->format('d M, Y | h:i:s a')}}</td>
                        </tr>
                        <tr>
                            <td>Update Time</td>
                            <td class="text-center">:</td>
                            <td>{{$tag->updated_at->format('d M, Y | h:i:s a')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
