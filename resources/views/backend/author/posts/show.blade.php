@extends('layouts.admin')

@push('css')

@endpush

@section('title', 'Singel Post')
@section('content')

<div class="container-fluid">

    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$post->title}}
                        <small>Posted by <strong><a href="#">{{$post->user->name}}
                            </a></strong> on {{$post->created_at->toFormattedDateString()}}</small>
                    </h2>
                </div>
                <div class="body">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach($post->categories as $category)
                    <span class="label bg-cyan">{{$category->name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach($post->tags as $tag)
                    <span class="label bg-green">{{$tag->name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        Featured Image
                    </h2>
                </div>
                <div class="body">
                    <img class="w-270" src="{{asset('storage/post/'.$post->image)}}" alt="post{{$post->id}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<!-- Select Plugin Js -->
<script type="text/javascript" src="{{asset('contents/backend')}}/plugins/bootstrap-select/js/bootstrap-select.js">
</script>
<!-- tinymce -->
<script type="text/javascript" src="{{asset('contents/backend')}}/plugins/tinymce/tinymce.js"></script>

<script>
    $(function () {
        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '{{asset('
        contents / backend ')}}/plugins/tinymce';
    });

</script>

@endpush
