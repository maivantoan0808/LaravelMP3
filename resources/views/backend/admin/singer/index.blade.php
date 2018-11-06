@extends('backend.layouts.app')

@section('title', 'Singer')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL SINGER
                        <span class="badge bg-blue">{{ $singers->count() }}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($singers as $key=>$sg)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $sg->name }} </td>
                                    <td> {{ $sg->email }} </td>
                                    <td> {{ $sg->created_at }} </td>
                                    <td> {{ $sg->updated_at }} </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.singer.show', $sg->id) }}"
                                            class="btn btn-info waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <button class="btn btn-danger waves-effect" 
                                            type="button" 
                                            onclick="deleteCategory({{ $sg->id }})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{ $sg->id }}" action="{{ route('admin.singer.destroy', $sg->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
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
<script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
function deleteCategory(id){
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    })

    swalWithBootstrapButtons({
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
            document.getElementById('delete-form-'+id).submit();
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your data is safe :)',
                'error'
            )
        }
    })
}
</script>
@endpush