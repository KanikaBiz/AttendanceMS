<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="form-group">
    <label for="title" class="form-control-label"><strong>{{ trans('cruds.role.fields.title') }}</strong>: <span
        class="text-danger">*</span></label>
    <input id="title" name="title" class="form-control" type="text"
      placeholder="{{ trans('cruds.customer.fields.title') }}">
    <span class="text-danger error-text title_error"></span>
  </div>
</div>

<div class="form-group pt-2">
  <label class="form-control-label"><strong>{{ trans('cruds.role.fields.permissions') }}</strong><span
      class="text-danger">*</span>
    @error('permissions')
      <span class="text-danger text-sm">{{ $message }}</span>
    @enderror
  </label>
  <br>
  <div class="col-12 py-2">
    <table id="dynamic-table" class="table table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th width="25%">Group</th>
          <th class="text-center align-middle">
            <div class="form-check d-inline">
              <div class="icheck-primary d-inline">
                <input type="checkbox" id="selectall" name="selectall">
                <label for="selectall">
                </label>
              </div>
            </div>
          </th>
          <th>Access <span class="text-danger error-text permissions_error"></span></th>
        </tr>
      </thead>
      <tbody id="object_permission">
        @if ($all_permissions)
          @foreach ($all_permissions as $permission)
            <tr>
              <td><strong>{{ $permission[0]['group'] }}</strong></td>
              <td class="text-center align-middle">
                <div class="icheck-primary d-inline">
                  <input type="checkbox" id="chkIds{{ $permission[0]['id'] }}" name="chkIds"
                    value="{{ $permission[0]['group'] }}" class="form-check-input group align-middle">
                  <label for="chkIds{{ $permission[0]['id'] }}">
                  </label>
                </div>
              </td>
              <td>
                @foreach ($permission as $access)
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="permissions{{ $access['id'] }}" name="permissions[]"
                      value="{{ $access['id'] }}" class="form-check-input permissions">
                    <label for="permissions{{ $access['id'] }}">
                      {{ $access['title'] }}
                    </label>
                  </div>
                @endforeach
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="3">No data found.</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="col-12 pt-3">
  <div class="form-group clearfix">
    <div class="icheck-primary d-inline">
      <input type="checkbox" id="role_status" name="role_status">
      <label for="role_status">
        <strong>&nbsp;{{ trans('global.status') }}</strong>
      </label>
    </div>
  </div>
</div>
