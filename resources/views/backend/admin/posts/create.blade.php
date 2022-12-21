
@extends('layouts.admin')

@push('css')
<!-- Bootstrap Select Css -->
<link href="{{asset('contents/backend')}}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('title', 'Create New Post')
@section('content')

<div class="container-fluid">
    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add New Post
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control">
                                <label class="form-label">Post Title</label>
                            </div>
                        </div>
                        <div class="form-group form-float pb-35">
                            <label for="image">Featured Image</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categories and Tags
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float mb-10">
                            <div class="form-line {{$errors->has('categories') ? 'focused error':''}}">
                                <label>select categories</label>
                                <select name="categories[]" class="form-control show-tick" data-live-search="true"
                                    multiple>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float mb-10">
                            <div class="form-line {{$errors->has('tags') ? 'focused error':''}}">
                                <label>select Tags</label>
                                <select name="tags[]" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a class="btn btn-danger waves-effect" href="{{route('admin.posts.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary waves-effect">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Body
                        </h2>
                    </div>
                    <div class="body">
                        <textarea name="body" id="tinymce">

                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('js')
<!-- Select Plugin Js -->
<script type="text/javascript" src="{{asset('contents/backend')}}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
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
        tinyMCE.baseURL = '{{asset('contents/backend')}}/plugins/tinymce';
    });

</script>

@endpush
