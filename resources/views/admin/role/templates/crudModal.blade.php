<div class="modal fade" id="crudObjectModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <form id="frmCrudObject" action="{{ route('admin.' . $crudRoutePath . '.store') }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="object_id" id="object_id">
          <input type="hidden" name="crudRoutePath" id="crudRoutePath" value="{{ $crudRoutePath }}">
          @include('admin.role.permission_form')
        </div>
        <div class="modal-footer">
          @include('admin.templates.button')
        </div>
      </form>
    </div>
  </div>
</div>

{{-- <div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Extra Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- /.card -->
        <!-- Horizontal Form -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Horizontal Form</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck2">Remember me</label>
                  </div>
                </div>
              </div>
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="checkbox" id="checkboxPrimary1" checked="">
                  <label for="checkboxPrimary1">
                  </label>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info">Sign in</button>
              <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal --> --}}
