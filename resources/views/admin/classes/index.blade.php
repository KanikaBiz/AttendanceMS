@extends('admin.layouts.master_layout')

@push('styles')
    <link href="{{ assetUrl() }}assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/toggle.css">
    <link rel="stylesheet"
        href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Classes'))
@section('breadcrumb_pagename', trans('Class List'))

@section('breadcrumb', trans('Manage Class'))

{{-- Crud Classes Form --}}

{{-- Modal --}}
<div class="modal fade" id="crudObjectModal" tabindex="-1" role="dialog" aria-labelledby="crudObjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudObjectModalLabel">{{ trans('global.add') }} {{ trans('global.new') }}
                    {{ trans('Manage Class') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crudObjectForm" action="{{ route('admin.classes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="object_id" value="">
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="code">Class Code</label>
                        <input type="text" name="code" id="code" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="description">Class Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('global.close') }}</button>
                <button type="submit" form="crudObjectForm" class="btn btn-primary">{{ trans('global.save') }}</button>
            </div>
        </div>
    </div>
</div>

{{-- List Semester --}}
<div class="card">
    <div class="card-header">
        <h4 class="mb-0 text-primary"><i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('global.list') }}
            {{ trans('Manage Semester') }}
            @can($prefix . 'create')
                <button id="addNewObject" type="button" class="btn btn-sm btn-outline-primary px-4 radius-30"
                    style="float: right;" data-toggle="modal" data-target="#crudObjectModal">
                    <i class='bx bxs-plus-square'></i> {{ trans('global.add') }} {{ trans('global.new') }}
                </button>
            @endcan
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Semester</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="objectList">
                    @foreach ($classes as $row)
                        <tr id="tr_object_id_{{ $row->id }}">
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->semester->name }}</td>
                            <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
                            <td>
                                <input id="status" name="status" data-id="{{ $row->id }}"
                                    {{ $row->status ? 'checked' : '' }} title="Status" type="checkbox"
                                    class="ace-switch input-lg ace-switch-yesno bgc-green-d2 text-grey-m2" />
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                  @can($prefix . 'edit')
                                    <a id="objectEdit" data-id="{{ $row->id }}" href="{{ route('admin.' . $crudRoutePath . '.edit', $row->id) }}"
                                      class="objectEdit btn btn-sm btn-success" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom"
                                      title="Edit info" aria-label="Edit"><i class="fas fa-edit"></i></a>
                                  @endcan
                                  |
                                  @can($prefix . 'delete')
                                    <a id="objectDelete" data-id="{{ $row->id }}"
                                      href="{{ route('admin.' . $crudRoutePath . '.destroy', $row->id) }}" class="objectDelete btn btn-sm btn-danger"
                                      data-toggle="tooltip" data-placement="bottom" title="Delete" aria-label="Delete"><i
                                        class="far fa-trash-alt"></i></a>
                                  @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Semester</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script>
    $(function() {
        "use strict";
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });
            table.buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
        });
    });
    $(function() {
        "use strict";
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2({
            dropdownParent: $('#crudObjectModal'),
            placeholder: '{{ trans('global.select') }} {{ trans('cruds.user.fields.roles') }}',
            allowClear: Boolean($(this).data('allow-clear')),
        });
    });
</script>
@endpush
