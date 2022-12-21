@extends('layouts.admin')

@push('css')
<link href="{{asset('contents/backend')}}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"
    rel="stylesheet">
@endpush

@section('title', 'Posts')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <a class="btn btn-primary waves-effect" href="{{route('author.posts.create')}}">
            <i class="material-icons">add</i>
            <span>Create New Post</span>
        </a>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EXPORTABLE TABLE
                    <span class="badge badge-primary">{{$posts->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>View</th>
                                    <th>Is Approve</th>
                                    <th>Create Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>View</th>
                                    <th>Is Approve</th>
                                    <th>Create Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($posts as $key=>$post)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{str_limit($post->title,40)}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->view_count}}</td>
                                    <td>
                                        @if($post->is_approved == true)
                                            <span class="badge badge-primary">Approved</span>
                                        
                                        @else
                                            <span class="badge bg-pink">Pending</span>
                                        
                                        @endif
                                    </td>
                                    <td>{{$post->created_at->format('d M, Y | h:i:s a')}}</td>
                                    <td class="text-center">
                                        <a href="{{route('author.posts.show',$post->id)}}"
                                            class="btn-sm btn-primary waves-effect">
                                            <i class="material-icons">add</i>
                                        </a>
                                        <a href="{{route('author.posts.edit',$post->id)}}"
                                            class="btn-sm btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn-sm btn-danger waves-effect delete-action" type="button"
                                            onclick="deletePost({{$post->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$post->id}}"
                                            action="{{route('author.posts.destroy',$post->id)}}" method="post"
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
