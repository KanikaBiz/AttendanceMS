@extends('admin.layouts.master_layout')

@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/toggle.css">
  <link href="{{ assetUrl() }}assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
  <link href="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    rel="stylesheet">
  <link href="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
  <link href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"
    rel="stylesheet">
  <link href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css" rel="stylesheet">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Roles'))
@section('breadcrumb_pagename', trans('Role List'))

@section('breadcrumb', trans('cruds.role.title'))
<div class="card">
  <div class="card-header">
    <h4 class="mb-0 text-primary"><i class="fa fa-user me-1 font-22 text-primary"></i>{{ trans('global.list') }}
      {{ trans('cruds.role.title') }}
      @can($prefix . 'create')
        <button id="addNewObject" type="button" class="btn btn-sm btn-outline-primary px-4 radius-30"
          style="float: right;" data-toggle="modal" data-target="#crudObjectModal">
          <i class='fa fa-plus-square'></i> {{ trans('global.add') }} {{ trans('global.new') }}
        </button>
      @endcan
    </h4>
  </div>
  <div class="card-body">
    <div class="table mb-0">
      <table id="datatable" class="table table-striped table-bordered">
        <thead class="table-dark text-center">
          <tr>
            <th width="20">{{ trans('cruds.role.fields.id') }}</th>
            <th width="50">{{ trans('cruds.role.fields.title') }}</th>
            <th>{{ trans('cruds.role.fields.permissions') }}</th>
            <th width="80">{{ trans('cruds.role.fields.created_at') }}</th>
            <th width="65">{{ trans('global.status') }}</th>
            <th width="65">{{ trans('global.action') }}</th>
          </tr>
        </thead>
        <tbody id="objectList">
          @foreach ($roles as $row)
            <tr id="tr_object_id_{{ $row->id }}">
              <td>{{ $row->id }}</td>
              <td><strong>{{ $row->title }}</strong></td>
              <td>
                @foreach ($row->permissions as $p)
                  <span class="badge rounded-pill bg-secondary">{{ $p->title }}</span>
                @endforeach
              </td>
              <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
              <td>
                <input id="status" name="status" data-id="{{ $row->id }}" {{ $row->status ? 'checked' : '' }}
                  title="Status" type="checkbox"
                  class="ace-switch input-lg ace-switch-yesno bgc-green-d2 text-grey-m2" />
              </td>
              <td>
                @include('admin.templates.crudAction')
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>{{ trans('cruds.role.fields.id') }}</th>
            <th>{{ trans('cruds.role.fields.title') }}</th>
            <th>{{ trans('cruds.role.fields.permissions') }}</th>
            <th>{{ trans('cruds.role.fields.created_at') }}</th>
            <th>{{ trans('global.status') }}</th>
            <th>{{ trans('global.action') }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@include('admin.role.templates.crudModal')
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

<script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
{{-- initialize datatable --}}
<script>
  $(function() {
    "use strict";
    $(document).ready(function() {
      var table = $('#datatable').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
      });
      table.buttons().container()
        .appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
  });
  $(function() {
    "use strict";
    $('[data-toggle="tooltip"]').tooltip();

    // $('.single-select').select2({
    //   dropdownParent: $('#crudObjectModal'),
    //   theme: 'bootstrap4',
    //   width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    //   placeholder: $(this).data('placeholder'),
    //   allowClear: Boolean($(this).data('allow-clear')),
    // });
  })
</script>
{{-- check and uncheck all function --}}
<script>
  function check_uncheck() {
    $('#object_permission tr').each(function() {
      var inputlength = $(this).find('td:last').find('input').length;
      var checked = 0;
      $(this).find('td:last').find('input').each(function() {
        if ($(this).prop('checked')) {
          checked++;
        }
      });
      if (inputlength == checked) {
        $(this).find('td:first').next().find('input').prop('checked', true);
      } else {
        $(this).find('td:first').next().find('input').prop('checked', false);
      }
    });
    checkall();
  }

  function checkall() {
    var inputlength = $('.group').length;
    var checked = 0;
    $('.group').each(function() {
      if ($(this).prop('checked')) {
        checked++;
      }
    });
    if (inputlength == checked) {
      $('#selectall').prop('checked', true);
    } else {
      $('#selectall').prop('checked', false);
    }
  }
</script>
<script>
  $(document).ready(function() {
    $('table th input:checkbox').on('click', function() {
      var that = this;
      $(this).closest('table').find('input:checkbox').each(function() {
        this.checked = that.checked;
        $(this).closest('tr').toggleClass('selected');
      });
    });
    $('.group').on('click', function() {
      var that = this;
      $(this).closest('tr').find('input:checkbox').each(function() {
        this.checked = that.checked;
        $(this).closest('tr').toggleClass('selected');
      });
      checkall();
    });
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
  });
</script>

<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#addNewObject').on('click', function(e) {
      e.preventDefault();
      $('#crudObjectModal').find('.modal-title').html(
        '{{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}');
      $('#frmCrudObject').find('#object_id').val('');
      $('#frmCrudObject').find('#btnObjectSave').html(
        '<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
      $('#frmCrudObject').find('#btnObjectSave').removeClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').addClass('d-none');
      $('#frmCrudObject').trigger('reset');
    });

    $('#frmCrudObject').on('submit', function(e) {
      e.preventDefault();
      var actionUrl = $(this).attr('action');
      var method = $(this).attr('method')
      $('#btnObjectSave').html('Processing..');
      $('#btnObjectUpdate').html('Processing..');
      $.ajax({
        type: method,
        url: actionUrl,
        data: new FormData(this),
        dataType: 'json',
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function() {
          $(document).find('span.error-text').text('');
        },
        success: function(res) {
          console.log(res)
          if (res.status == 400) {
            $.each(res.error, function(prefix, val) {
              $('span.' + prefix + '_error').text(val[0]);
            });
          } else {
            var $html = $(res.html);
            if (res.type == 'store-object') {
              $('tbody#objectList').append($html);
            } else {
              $("#tr_object_id_" + res.data.id).replaceWith($html);
            }
            $('#frmCrudObject').trigger("reset");
            $('#crudObjectModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        },
        error: function(error) {
          console.log('Error:', error);
          $('#btnObjectSave').html('{{ trans('global.save') }}');
          $('#btnObjectUpdate').html('{{ trans('global.update') }}');
        }
      });
    });

    $('.permissions').change(check_uncheck);

    $('body').on('click', 'a#objectEdit', function(e) {
      e.preventDefault();
      $('#frmCrudObject').find('#btnObjectSave').addClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').removeClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').html(
        '<i class="fadeIn animated bx bx-edit"></i>&nbsp;{{ trans('global.update') }}');
      $('#frmCrudObject').trigger('reset');
      var object_id = $(this).data('id');
      var form = $('#frmCrudObject');
      var modal = $('#crudObjectModal');
      var actionUrl = $('#crudRoutePath').val();
      modal.find('.modal-title').html('{{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}');
      $.get(actionUrl + '/' + object_id + '/edit', function(res) {
        form.find('#object_id').val(res.data.id);
        form.find('#title').val(res.data.title);
        $.each(res.role_permissions, function(i, e) {
          $(`input[value="${i}"]`).prop(`checked`, true);
        });
        check_uncheck();
        if (res.data.status == 1) {
          form.find('#role_status').prop('checked', true);
        }
        modal.modal('show');
      })
    });

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

    $('#btnObjectClose').on('click', function(e) {
      e.preventDefault();
      $('#frmCrudObject').find('#btnObjectSave').removeClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').addClass('d-none');
      $('#crudObjectModal').find('.modal-title').html(
        '{{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}');
      $('#frmCrudObject').trigger('reset');
    });

    $('body').on('change', '.ace-switch', function(e) {
      var object_id = $(this).data('id');
      var status = $(this).prop('checked') == true ? 1 : 0;
      $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: '{{ route('admin.roles.changeStatus') }}',
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
