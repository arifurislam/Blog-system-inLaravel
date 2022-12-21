@extends('layouts.admin')

@push('css')
<link href="{{asset('contents/backend')}}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"
    rel="stylesheet">
@endpush

@section('title', 'Favorite Posts')
@section('content')

<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        FAVORITE POSTS
                        <span class="badge badge-primary">{{$posts->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Post Title</th>
                                    <th>Post Creator</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Views</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Post Title</th>
                                    <th>Post Creator</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Views</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($posts as $key=>$post)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{str_limit($post->title,40)}}</td>
                                    <td>{{$post->user->name}}</td>  
                                    <td>{{$post->favorite_to_users->count()}}</td>  
                                    <td>0</td>
                                    <td>0</td>
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
