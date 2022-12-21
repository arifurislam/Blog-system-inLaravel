@extends('layouts.admin')

@push('css')
<link href="{{asset('contents/backend')}}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"
    rel="stylesheet">
<style>
    .media{
        margin-bottom: 0;
        margin-top: 10px !important;
    }
    .mt-30{
        margin-top: 30px !important;
    }
</style>
@endpush

@section('title', 'Comments')
@section('content')

<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Comment
                        <span class="badge badge-primary">{{$comments->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th class="text-center">Comment Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th class="text-center">Comment Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($comments as $key=>$comment)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img style="height:64px; width:64px;" class="media-object"
                                                        src="{{asset('storage/profile/'.$comment->user->image)}}"
                                                        alt="Profile">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$comment->user->name}}
                                                    <small>{{$comment->created_at->diffForHumans()}}</small>
                                                    <p>{{$comment->comment}}</p>
                                                    <a target="_blank"
                                                        href="{{route('post.details',$comment->post->slug,'#comments')}}">Reply</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img style="height:64px; width:64px;" class="media-object"
                                                        src="{{asset('storage/profile/'.$comment->user->image)}}"
                                                        alt="Profile">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p>{{$comment->comment}}</p>
                                                <a target="_blank"
                                                    href="{{route('post.details',$comment->post->slug,'#comments')}}">
                                                    <h4 class="media-heading">{{str_limit($comment->post->title,'40')}}
                                                    </h4>
                                                </a>
                                                <p>by <strong>{{$comment->post->user->name}}</strong></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-sm btn-danger waves-effect delete-action mt-30" type="button"
                                            onclick="deletePost({{$comment->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$comment->id}}"
                                            action="{{route('admin.comments.destroy',$comment->id)}}" method="post"
                                            class="display-none">
                                            @csrf
                                            @method('delete')
                                        </form>
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
    <!-- #END# Exportable Table -->
</div>

@endsection
@push('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js">
</script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="{{asset('contents/backend')}}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="{{asset('contents/backend')}}/js/pages/tables/jquery-datatable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    function deletePost(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
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
@endpush
