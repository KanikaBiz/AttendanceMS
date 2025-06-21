@extends('admin.layouts.master_layout')

@push('styles')
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Attendance'))
@section('breadcrumb_pagename', trans('Edit Attendance'))
@section('breadcrumb', trans('Edit Attendance'))

<div class="card">
    <form action="{{ route('admin.attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label>{{ trans('Class') }}</label>
                <input type="text" class="form-control" value="{{ $attendance->classSubject->classSchedule->class_name }}" disabled>
            </div>
            <div class="form-group">
                <label>{{ trans('Subject') }}</label>
                <input type="text" class="form-control" value="{{ $attendance->classSubject->subject_name }}" disabled>
            </div>
            <div class="form-group">
                <label>{{ trans('Student') }}</label>
                <input type="text" class="form-control" value="{{ $attendance->student->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="attendance_date">{{ trans('Date') }}</label>
                <input type="date" class="form-control" value="{{ $attendance->attendance_date }}" disabled>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('Status') }} *</label>
                <select name="status" class="form-control" required>
                    <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Absent</option>
                    <option value="late" {{ $attendance->status === 'late' ? 'selected' : '' }}>Late</option>
                </select>
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('Remarks') }}</label>
                <input type="text" name="remarks" class="form-control" value="{{ old('remarks', $attendance->remarks) }}">
                @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ trans('Update') }}</button>
                <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">{{ trans('Cancel') }}</a>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    <script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
    </script>
@endpush
