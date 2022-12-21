@extends('layouts.website')

@push('css')
<link href="{{asset('contents/frontend')}}/single-post-1/css/styles.css" rel="stylesheet">
<link href="{{asset('contents/frontend')}}/single-post-1/css/responsive.css" rel="stylesheet">
<style>
    .favorite {
        color: #498BF9;
    }

</style>
@endpush

@section('title',)
{{$post->slug}}
@endsection


@section('content')

<div class="slider" style=" height:400px; width:100%; background-image: url({{asset('storage/post/'.$post->image)}});">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b>{{$post->title}}</b></h1>
		</div>
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{asset('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{$post->user->name}}</b></a>
									<h6 class="date">on {{$post->created_at->diffForHumans()}}</h6>
								</div>

							</div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

							<p class="para">
								{!! $post->body !!}
							</p>

							<ul class="tags">
								
									@foreach($post->tags as $tag)
									<li><a href="{{route('posts.tag',$tag->slug)}}">{{$tag->name}}</a></li>
									@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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
                                <li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
							<li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>
					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT Author</b></h4>
							<p>{{$post->user->about}}</p>
						</div>

						<div class="tag-area">

							<h4 class="title"><b>Categories</b></h4>
							<ul>
								@foreach($post->categories as $category)
								<li><a href="{{route('posts.category',$category->slug)}}">{{$category->name}}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">

				@foreach($randomposts as $randompost)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{asset('storage/post/'.$randompost->image)}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{asset('storage/profile/'.$randompost->user->image)}}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{route('post.details',$randompost->slug)}}"><b>{{$randompost->title}}</b></a></h4>

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
									<li><a href="#"><i class="ion-chatbubble"></i>{{$randompost->comments->count()}}</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$randompost->view_count}}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->

				@endforeach
			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@guest
							<p> To comment is this post , you need to "login" first
							<a style="color:#498BF9;" href="{{route('login')}}">Log in here</a>
							</p>
						@else
						<form method="post" action="{{route('comment.store',$post->id)}}">
							@csrf
							<div class="row">
								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						@endguest
					</div><!-- comment-form -->

					<h4><b>COMMENTS ({{$post->comments()->count()}})</b></h4>

					<div class="commnets-area ">
						@if($post->comments->count() > 0)

						@foreach($post->comments as $comment)
						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{asset('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{$comment->user->name}}</b></a>
									<h6 class="date"><b>on </b>{{$comment->created_at->diffForHumans()}}</h6>
								</div>
							</div><!-- post-info -->
							<p>{{$comment->comment}}</p>
						</div>
						@endforeach

						@else
						<div class="comment">
							<p>Leave your comment and be the frist one.</p>
						</div>
						@endif

					</div><!-- commnets-area -->

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection
@push('js')

@endpush
