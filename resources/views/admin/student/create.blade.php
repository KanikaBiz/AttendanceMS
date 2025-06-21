@extends('admin.layouts.master_layout')

@push('styles')
    <link href="{{ assetUrl() }}assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Teacher'))
@section('breadcrumb_pagename', trans('Create Teacher'))
@section('breadcrumb', trans('Create Teacher'))

<div class="card">
    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="name" class="form-control-label mb-1">{{ trans('cruds.user.fields.name') }}: <span class="text-danger">*</span></label>
                                <input id="name" name="name" class="form-control" type="text" value="{{ old('name') }}" placeholder="{{ trans('cruds.user.fields.name') }}">
                                <span class="text-danger error-text name_error">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="username" class="form-control-label mb-1">{{ trans('cruds.user.fields.username') }}: <span class="text-danger">*</span></label>
                                <input id="username" name="username" class="form-control" type="text" value="{{ old('username') }}" placeholder="{{ trans('cruds.user.fields.username') }}">
                                <span class="text-danger error-text username_error">@error('username') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label mb-1">{{ trans('cruds.user.fields.email') }}: <span class="text-danger">*</span></label>
                                <input id="email" name="email" class="form-control" type="email" value="{{ old('email') }}" placeholder="{{ trans('cruds.user.fields.email') }}">
                                <span class="text-danger error-text email_error">@error('email') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="phone_no" class="form-control-label mb-1">{{ trans('cruds.user.fields.phone_no') }}: <span class="text-danger">*</span></label>
                                <input id="phone_no" name="phone_no" class="form-control" type="text" value="{{ old('phone_no') }}" placeholder="{{ trans('cruds.user.fields.phone_no') }}">
                                <span class="text-danger error-text phone_no_error">@error('phone_no') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label mb-1">{{ trans('cruds.user.fields.password') }}: <span class="text-danger">*</span></label>
                                <input id="password" name="password" class="form-control" type="password" placeholder="{{ trans('cruds.user.fields.password') }}">
                                <span class="text-danger error-text password_error">@error('password') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label mb-1">{{ trans('cruds.user.fields.password_confirmation') }}: <span class="text-danger">*</span></label>
                                <input id="password_confirmation" name="password_confirmation" class="form-control" type="password" placeholder="{{ trans('cruds.user.fields.password_confirmation') }}">
                                <span class="text-danger error-text password_confirmation_error">@error('password_confirmation') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group mt-4">
                                <div class="custom-control custom-switch">
                                    <input id="status" name="status" class="custom-control-input" type="checkbox" checked>
                                    <label class="custom-control-label" for="status"><strong>{{ trans('global.status') }}</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group text-center">
                        <label for="profile_image" class="form-control-label mb-1">{{ trans('cruds.user.fields.profile_image') }}</label>
                        <img src="{{ asset('images/no-image.png') }}" class="img-thumbnail form-control" id="showPhoto" alt="Profile Image" style="height: 250px;">
                        <input onchange="showPreview(event);" type="file" name="profile_image" id="profile_image" accept="image/png,image/jpg,image/jpeg" hidden />
                        <div style="text-align: center" class="mt-2">
                            <input type="button" onclick="document.getElementById('profile_image').click()" name="browse_file" id="browse_file" class="btn btn-success btn-browse form-control" value="Upload">
                        </div>
                        <span class="text-danger error-text profile_image_error">@error('profile_image') {{ $message }} @enderror</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ trans('Save') }}</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">{{ trans('Cancel') }}</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    <script src="{{ assetUrl() }}assets/backend/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>

    <script>
        function showPreview(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const url = URL.createObjectURL(input.files[0]);
                document.getElementById('showPhoto').src = url;
            }
        }
    </script>
@endpush
