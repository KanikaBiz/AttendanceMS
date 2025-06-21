@extends('admin.layouts.master_layout')

@push('styles')
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Class Schedule'))
@section('breadcrumb_pagename', trans('Edit Class Schedule'))
@section('breadcrumb', trans('Edit Class Schedule'))

<div class="card">
    <form action="{{ route('admin.class-schedules.update', $schedule->id) }}" method="POST" id="classScheduleForm">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="class_name">{{ trans('Class Name') }} *</label>
                <input type="text" name="class_name" class="form-control" value="{{ old('class_name', $schedule->class_name) }}" required>
                @error('class_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="class_code">{{ trans('Class Code') }} *</label>
                <input type="text" name="class_code" class="form-control" value="{{ old('class_code', $schedule->class_code) }}" required>
                @error('class_code') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="semester">{{ trans('Semester') }} *</label>
                <input type="text" name="semester" class="form-control" value="{{ old('semester', $schedule->semester) }}" required>
                @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="class_description">{{ trans('Class Description') }}</label>
                <textarea name="class_description" class="form-control">{{ old('class_description', $schedule->class_description) }}</textarea>
                @error('class_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <h4>{{ trans('Subjects') }}</h4>
            <div id="subjects-container">
                @foreach ($schedule->subjects as $index => $subject)
                    <div class="subject-row row mb-3">
                        <div class="form-group col-md-2">
                            <label>{{ trans('Subject Code') }} *</label>
                            <input type="text" name="subjects[{{ $index }}][subject_code]" class="form-control" value="{{ $subject->subject_code }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>{{ trans('Subject Name') }} *</label>
                            <input type="text" name="subjects[{{ $index }}][subject_name]" class="form-control" value="{{ $subject->subject_name }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>{{ trans('Teacher') }} *</label>
                            <select name="subjects[{{ $index }}][teacher_id]" class="form-control" required>
                                <option value="">Select Teacher</option>
                                @foreach ($teachers as $id => $name)
                                    <option value="{{ $id }}" {{ $subject->teacher_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>{{ trans('Day') }} *</label>
                            <select name="subjects[{{ $index }}][day]" class="form-control" required>
                                <option value="Monday" {{ $subject->day == 'Monday' ? 'selected' : '' }}>Monday</option>
                                <option value="Tue" {{ $subject->day == 'Tue' ? 'selected' : '' }}>Tue</option>
                                <option value="Wed" {{ $subject->day == 'Wed' ? 'selected' : '' }}>Wed</option>
                                <option value="Thu" {{ $subject->day == 'Thu' ? 'selected' : '' }}>Thu</option>
                                <option value="Fri" {{ $subject->day == 'Fri' ? 'selected' : '' }}>Fri</option>
                                <option value="Sat" {{ $subject->day == 'Sat' ? 'selected' : '' }}>Sat</option>
                                <option value="Sun" {{ $subject->day == 'Sun' ? 'selected' : '' }}>Sun</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>{{ trans('Total Credit') }} *</label>
                            <input type="number" name="subjects[{{ $index }}][total_credit]" class="form-control" value="{{ $subject->total_credit }}" required min="1" max="10">
                        </div>
                        <div class="form-group col-md-1">
                            <label>&nbsp;</label><br>
                            <button type="button" class="btn btn-danger remove-subject" style="margin-top: 5px;">-</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-subject" class="btn btn-success mt-2">+</button>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ trans('Update') }}</button>
                <a href="{{ route('admin.class-schedules.index') }}" class="btn btn-secondary">{{ trans('Cancel') }}</a>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    <script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>

    <script>
        let subjectIndex = {{ count($schedule->subjects) }};

        $('#add-subject').click(function() {
            const row = `
                <div class="subject-row row mb-3">
                    <div class="form-group col-md-2">
                        <label>{{ trans('Subject Code') }} *</label>
                        <input type="text" name="subjects[${subjectIndex}][subject_code]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ trans('Subject Name') }} *</label>
                        <input type="text" name="subjects[${subjectIndex}][subject_name]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ trans('Teacher') }} *</label>
                        <select name="subjects[${subjectIndex}][teacher_id]" class="form-control" required>
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ trans('Day') }} *</label>
                        <select name="subjects[${subjectIndex}][day]" class="form-control" required>
                            <option value="Monday">Monday</option>
                            <option value="Tue">Tue</option>
                            <option value="Wed">Wed</option>
                            <option value="Thu">Thu</option>
                            <option value="Fri">Fri</option>
                            <option value="Sat">Sat</option>
                            <option value="Sun">Sun</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ trans('Total Credit') }} *</label>
                        <input type="number" name="subjects[${subjectIndex}][total_credit]" class="form-control" required min="1" max="10">
                    </div>
                    <div class="form-group col-md-1">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-danger remove-subject" style="margin-top: 5px;">-</button>
                    </div>
                </div>
            `;
            $('#subjects-container').append(row);
            subjectIndex++;
        });

        $(document).on('click', '.remove-subject', function() {
            $(this).closest('.subject-row').remove();
        });

        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
    </script>
@endpush
