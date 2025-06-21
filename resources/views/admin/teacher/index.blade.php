@extends('admin.layouts.master_layout')

@push('styles')
    <link href="{{ assetUrl() }}assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/toggle.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Teacher'))
@section('breadcrumb_pagename', trans('Teacher List'))
@section('breadcrumb', trans('Teacher List'))

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ trans('Teacher List') }}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">{{ trans('Add Teacher') }}</a>
        </div>
    </div>
    <div class="card-body">
        <table id="teacherTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ trans('cruds.user.fields.name') }}</th>
                    <th>{{ trans('cruds.user.fields.username') }}</th>
                    <th>{{ trans('cruds.user.fields.email') }}</th>
                    <th>{{ trans('cruds.user.fields.phone_no') }}</th>
                    <th>{{ trans('cruds.user.fields.profile_image') }}</th>
                    <th>{{ trans('global.status') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_no }}</td>
                        <td>
                            @if ($user->profile_image)
                                <img src="{{ asset('uploads/user/' . $user->profile_image) }}" alt="Profile" style="width: 50px; height: 50px;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" style="width: 50px; height: 50px;">
                            @endif
                        </td>
                        <td>
                          <input id="status" name="status" data-id="{{ $user->id }}" {{ $user->status?'checked':'' }} title="Status" type="checkbox" class="ace-switch input-lg ace-switch-yesno bgc-green-d2 text-grey-m2" />
                        </td>
                        <td>
                            <a href="{{ route('admin.teachers.edit', $user->id) }}" class="btn btn-sm btn-warning">{{ trans('Edit') }}</a>
                            <button type="button" class="btn btn-sm btn-danger delete-teacher" data-id="{{ $user->id }}" data-url="{{ route('admin.teachers.destroy', $user->id) }}">{{ trans('Delete') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/jszip/jszip.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>

    <script>
        $(function () {
            $("#teacherTable").DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#teacherTable_wrapper .col-md-6:eq(0)');

            // SweetAlert for delete confirmation
            $('.delete-teacher').on('click', function () {
                var url = $(this).data('url');
                Swal.fire({
                    title: '{{ trans("Are you sure?") }}',
                    text: "{{ trans('You will not be able to recover this teacher!') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ trans("Yes, delete it!") }}',
                    cancelButtonText: '{{ trans("Cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                toastr.success(response.message);
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            },
                            error: function (xhr) {
                                toastr.error('{{ trans("Error deleting teacher.") }}');
                            }
                        });
                    }
                });
            });

            $('body').on('change', '.ace-switch', function(e) {
                var object_id = $(this).data('id');
                var status = $(this).prop('checked') == true ? 1 : 0;
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: '{{ route('admin.users.changeStatus') }}',
                    data: {
                        'status': status,
                        'object_id': object_id
                    },
                    success: function(res) {
                        toastr.success(res.success);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            });

            // Toastr for success message
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@endpush
