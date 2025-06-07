<div class="modal fade" id="crudObjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="name"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.name') }}: <span
                                                class="text-danger">*</span></label>
                                        <input id="name" name="name" class="form-control" type="text"
                                            placeholder="{{ trans('cruds.user.fields.name') }}">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="username"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.username') }}:
                                            <span class="text-danger">*</span></label>
                                        <input id="username" name="username" class="form-control" type="text"
                                            placeholder="{{ trans('cruds.user.fields.username') }}">
                                        <span class="text-danger error-text username_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="email"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.email') }}:
                                            <span class="text-danger">*</span></label>
                                        <input id="email" name="email" class="form-control" type="email"
                                            placeholder="{{ trans('cruds.user.fields.email') }}">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="phone_no"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.phone_no') }}:
                                            <span class="text-danger">*</span></label>
                                        <input id="phone_no" name="phone_no" class="form-control" type="text"
                                            placeholder="{{ trans('cruds.user.fields.phone_no') }}">
                                        <span class="text-danger error-text phone_no_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="password"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.password') }}:
                                            <span class="text-danger">*</span></label>
                                        <input id="password" name="password" class="form-control" type="password"
                                            placeholder="{{ trans('cruds.user.fields.password') }}">
                                        <span class="text-danger error-text password_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="password_confirmation"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.password_confirmation') }}:
                                            <span class="text-danger">*</span></label>
                                        <input id="password_confirmation" name="password_confirmation"
                                            class="form-control" type="password"
                                            placeholder="{{ trans('cruds.user.fields.password_confirmation') }}">
                                        <span class="text-danger error-text password_confirmation_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="roles"
                                            class="form-control-label mb-1">{{ trans('cruds.user.fields.roles') }}:
                                            <span class="text-danger">*</span></label>
                                        <select id="roles" name="roles[]" class="select2" multiple="multiple"
                                            style="width: 100%;">
                                            @foreach ($roles as $key => $row)
                                                <option value="{{ $key }}">{{ $row }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text roles_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mt-4">
                                        <div class="custom-control custom-switch">
                                            <input id="user_status" name="user_status" class="custom-control-input"
                                                type="checkbox" checked>
                                            <label class="custom-control-label"
                                                for="user_status"><strong>{{ trans('global.status') }}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group text-center">
                                <label for="name"
                                    class="form-control-label mb-1">{{ trans('cruds.user.fields.profile_image') }}</label>
                                <input type="hidden" name="old_image" id="old_image">
                                <img src="{{ errorImageUrl() }}" class="img-thumbnail form-control" id="showPhoto"
                                    alt="Profile Image" onerror="onErrorImage(event)" style="height: 250px;">
                                <input onchange="showPreview(event);" type="file" name="profile_image"
                                    id="profile_image" accept="image/x-png,image/png,image/jpg,image/jpeg" hidden />
                                <div style="text-align: center">
                                    <input type="button" onclick="document.getElementById('profile_image').click()"
                                        name="browse_file" id="browse_file"
                                        class="btn btn-success btn-browse form-control" value="Upload">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @include('admin.templates.button')
                </div>
            </form>
        </div>
    </div>
</div>
