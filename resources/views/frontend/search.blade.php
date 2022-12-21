@extends('layouts.website')

@push('css')
<link href="{{asset('contents/frontend')}}/category/styles.css" rel="stylesheet">
<link href="{{asset('contents/frontend')}}/category/responsive.css" rel="stylesheet">

@endpush

@section('title', 'Post by Category')

@section('content')


<div class="slider display-table center-text" style=" background-image: url({{asset('contents/frontend/images/category-1.jpg')}});">
    <h1 class="title display-table-cell"><b>{{$posts->count()}} result for : {{$query}}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{asset('storage/post/'.$post->image)}}" alt="Blog Image">
                        </div>

                        <a class="avatar" href="{{url('profile/'.$post->user->username)}}"><img src="{{asset('storage/profile/'.$post->user->image)}}"
                                alt="Profile Image"></a>

                        <div class="blog-info">

                            <h4 class="title"><a
                                    href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript::void(0);" onclick="toastr.info('To add favirite list, you need to log in frist','Info',{
                                                closeButton:true,
                                                progressBar:true,
                                            })"><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>
                                    @else
                                    <a href="javascript::void(0);"
                                        onclick="document.getElementById('favorite-post-{{$post->id}}').submit();"
                                        class="{{Auth::user()->favorite_posts->
                                        where('pivot.post_id',$post->id)->count() == 0 ? '':'favorite'}}">
                                        <i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>

                                    <form id="favorite-post-{{$post->id}}" method="post"
                                        action="{{route('post.favorite',$post->id)}}" style="display:none;">
                                        @csrf
                                    </form>
                                    @endguest

                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>0</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            @else
            <div class="col-lg-3"></div>
            <div class="col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-info">
                            <h4 class="title">
                                <strong>There is no post :( </strong>
                            </h4>
                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endif
        </div><!-- row -->



    </div><!-- container -->
</section><!-- section -->


@endsection
@push('js')

@endpush
