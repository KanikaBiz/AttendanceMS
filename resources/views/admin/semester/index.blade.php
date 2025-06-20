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
@section('breadcrumb_title', trans('Manage Semesters'))
@section('breadcrumb_pagename', trans('Semester List'))

@section('breadcrumb', trans('Manage Semester'))

{{-- Crud Semesters Form --}}

{{-- Modal --}}
<div class="modal fade" id="crudObjectModal" tabindex="-1" role="dialog" aria-labelledby="crudObjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudObjectModalLabel">{{ trans('global.add') }} {{ trans('global.new') }}
                    {{ trans('Manage Semester') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crudObjectForm" action="{{ route('admin.semesters.store') }}" method="POST">
                     {{ csrf_field() }}
                      <input type="hidden" name="object_id" id="object_id">
                      <input type="hidden" name="crudRoutePath" id="crudRoutePath" value="{{ $crudRoutePath }}">
                    <div class="form-group">
                        <label for="name">Semester Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="">
                    </div>

                    {{-- Get Data from Model Year put into select2 --}}
                    <div class="form-group">
                        <label for="year_id">Year</label>
                        <select name="year_id" id="year_id" class="form-control select2" style="width: 100%;">
                            <option value="" selected disabled>{{ trans('global.select_year') }}</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                            @endforeach
                        </select>
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
                        <th>Year</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="objectList">
                    @foreach ($semesters as $row)
                        <tr id="tr_object_id_{{ $row->id }}">
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->year->name }}</td>
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
                        <th>Year</th>
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

{{-- Save and Update Semester --}}

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    // Clear Modal Form and set mode
    $('#addNewObject').on('click', function() {
        $('#crudObjectForm').trigger("reset");
        $('#crudObjectModalLabel').html('Add New Subject');
        $('#crudObjectForm').attr('action', '{{ route("admin.semesters.store") }}');
        $('#crudObjectForm').attr('method', 'POST');
        $('#object_id').val('');
        $('#crudObjectModal').modal('show');
    });

    // Edit Object
    $(document).on('click', '.objectEdit', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route("admin.semesters.index") }}/' + id + '/edit',
            type: 'GET',
            success: function(res) {
                $('#crudObjectModalLabel').html('Edit Subject');
                $('#crudObjectForm').attr('action', '{{ route("admin.semesters.store") }}');
                $('#crudObjectForm').attr('method', 'POST');
                $('#object_id').val(res.id);
                $('#name').val(res.name);
                $('#year_id').val(res.year_id).trigger('change');
                $('#crudObjectModal').modal('show');
            },
            error: function(error) {
                toastr.error('Error fetching subject data');
            }
        });
    });

    // Save/Update Object
    $('#crudObjectForm').on('submit', function(e) {
        e.preventDefault();
        let actionUrl = $(this).attr('action');
        let formData = new FormData(this);

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
                $('.btn-primary').html('Processing...').prop('disabled', true);
            },
            success: function(res) {
                if (res.status === 400) {
                    $.each(res.error, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    if (res.type === 'store-object') {
                        $('tbody#objectList').append(res.html);
                        toastr.success(res.success);
                    } else {
                        $("#tr_object_id_" + res.data.id).replaceWith(res.html);
                        toastr.success(res.success);
                    }
                    $('#crudObjectForm').trigger("reset");
                    $('#crudObjectModal').modal('hide');
                }
                $('.btn-primary').html('{{ trans("global.save") }}').prop('disabled', false);
            },
            error: function(error) {
                toastr.error('An error occurred');
                $('.btn-primary').html('{{ trans("global.save") }}').prop('disabled', false);
            }
        });
    });

    // Delete Object
    $('body').on('click', '.objectDelete', function(e) {
          e.preventDefault();
          var object_id = $(this).data("id");
          var link = $(this).attr("href");
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "DELETE",
                url: link,
                success: function(data) {
                  $("#tr_object_id_" + object_id).remove();
                  toastr.success(data.success);
                },
                error: function(data) {
                  console.log('Error:', data);
                }
              });
            }
          })
        });

      // Status Toggle
      $('body').on('change', '.ace-switch', function(e) {
        var object_id = $(this).data('id');
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
          type: 'GET',
          dataType: 'JSON',
          url: '{{ route('admin.semesters.changeStatus') }}',
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
    });
  </script>

@endpush
