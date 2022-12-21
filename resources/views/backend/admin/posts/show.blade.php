@extends('layouts.admin')

@push('css')

@endpush

@section('title', 'Create New Post')
@section('content')

<div class="container-fluid">

    <a href="{{route('admin.posts.index')}}" class="btn btn-danger weves-effect">
        <span>Back</span>
        <i class="material-icons">fast_forward</i>
    </a>
    @if($post->is_approved == false)
        <button type="submit" class="btn btn-success waves-effect pull-right" onclick="approvepost
        ({{$post->id}})">
            <i class="material-icons">done</i>
            <span>Approve</span>
        </button>
        <form method="POST" action="{{route('admin.post.approve',$post->id)}}" id="approval-form" style="display:none;">
            @csrf
            @method('PUT')
        </form>
    @else
        <button type="submit" class="btn btn-success waves-effect pull-right disabled">
            <i class="material-icons">done</i>
            <span>Approved</span>
        </button>
    @endif
    <br>
    <br>
    
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
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
    function approvepost(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to approve the post ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Approve !!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approval-form').submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
<script type="text/javascript">
    

</script>
@endpush
