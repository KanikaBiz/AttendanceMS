@extends('layouts.master_lte')
@section('title', 'Users')
@section('custom_css')
{{-- css datatable --}}
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endsection
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Manage Users</h2>
                    <div class="card-tools">
                        <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Add User
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                    {{$role->name}}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{route('admin.users.destroy', $user->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- javascript datatable --}}
<script src="{{asset('AdminLte')}}/plugins/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('AdminLte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLte')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
{{-- Ask with sweet alert before delete record --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.btn-danger').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection

