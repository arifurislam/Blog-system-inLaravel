@extends('layouts.admin')

@push('css')

@endpush

@section('title', 'Admin')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15"
                        data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL FAVORITE</div>
                    <div class="number count-to" data-from="0" data-to="{{Auth::user()->favorite_posts->count()}}"
                        data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text">PENDING POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{$pending_posts}}" data-speed="1000"
                        data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">remove_red_eye</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL VIEWS</div>
                    <div class="number count-to" data-from="0" data-to="{{$all_view}}" data-speed="1000"
                        data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    {{-- 2nd row --}}
    <div class="row clearfix">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-red hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">apps</i>
                </div>
                <div class="content">
                    <div class="text">CATEGORIES</div>
                    <div class="number count-to" data-from="0" data-to="{{$categories}}" data-speed="15"
                        data-fresh-interval="20"></div>
                </div>
            </div>

            <div class="info-box bg-blue-grey hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">label</i>
                </div>
                <div class="content">
                    <div class="text">TAGS</div>
                    <div class="number count-to" data-from="0" data-to="{{$tags}}" data-speed="15"
                        data-fresh-interval="20"></div>
                </div>
            </div>

            <div class="info-box bg-indigo hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL AUTHOR</div>
                    <div class="number count-to" data-from="0" data-to="{{$authors}}" data-speed="15"
                        data-fresh-interval="20"></div>
                </div>
            </div>

            <div class="info-box bg-deep-orange hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">fiber_new</i>
                </div>
                <div class="content">
                    <div class="text">TODAY AUTHOR</div>
                    <div class="number count-to" data-from="0" data-to="{{$authors}}" data-speed="15"
                        data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-1">
            <div class="card">
                <div class="header">
                    <h2>MOST POPULAR POSTS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Views</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popular_post as $key=>$post)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{str_limit($post->title,20)}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->view_count}}</td>
                                    <td>{{$post->favorite_to_users_count}}</td>
                                    <td>{{$post->comments_count}}</td>
                                    <td>
                                        <a target="_blank" class="btn  btn-primary waves-effect" href="{{route('post.details',$post->slug)}}">
                                            view</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Top 10 Author Activity</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank List</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($active_authors as $key=>$author)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$author->name}}</td>
                                    <td>{{$author->posts_count}}</td>
                                    <td>{{$author->comments_count}}</td>
                                    <td>{{$author->favorite_posts_count}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->

    </div>
</div>


@endsection
@push('js')
<script src="{{asset('contents/backend')}}/plugins/jquery-countto/jquery.countTo.js"></script>
<script src="{{asset('contents/backend')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('contents/backend')}}/plugins/morrisjs/morris.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{asset('contents/backend')}}/js/pages/index.js"></script>

@endpush
