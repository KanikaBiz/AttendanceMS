@extends('admin.layouts.master_layout')

@push('styles')
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Attendance'))
@section('breadcrumb_pagename', trans('Record Attendance'))
@section('breadcrumb', trans('Record Attendance'))

<div class="card">
    <form action="{{ route('admin.attendances.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="class_subject_id">{{ trans('Class Subject') }} *</label>
                <select name="class_subject_id" class="form-control" required>
                    <option value="">Select Subject</option>
                    @foreach ($schedules as $schedule)
                        @foreach ($schedule->subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $schedule->class_name }} - {{ $subject->subject_name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @error('class_subject_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="attendance_date">{{ trans('Date') }} *</label>
                <input type="date" name="attendance_date" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                @error('attendance_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <h4>{{ trans('Students Attendance') }}</h4>
            <div id="attendance-container">
                @foreach ($students as $id => $name)
                    <div class="attendance-row row mb-2">
                        <div class="form-group col-md-4">
                            <label>{{ $name }}</label>
                            <input type="hidden" name="attendances[{{ $loop->index }}][student_id]" value="{{ $id }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label>{{ trans('Status') }}</label>
                            <select name="attendances[{{ $loop->index }}][status]" class="form-control">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ trans('Remarks') }}</label>
                            <input type="text" name="attendances[{{ $loop->index }}][remarks]" class="form-control">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ trans('Save') }}</button>
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
