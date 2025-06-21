@extends('admin.layouts.master_layout')

@push('styles')
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Class Schedule'))
@section('breadcrumb_pagename', trans('Create Class Schedule'))
@section('breadcrumb', trans('Create Class Schedule'))

<div class="card">
    <form action="{{ route('admin.class-schedules.store') }}" method="POST" id="classScheduleForm">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="class_name">{{ trans('Class Name') }} *</label>
                <input type="text" name="class_name" class="form-control" required>
                @error('class_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="class_code">{{ trans('Class Code') }} *</label>
                <input type="text" name="class_code" class="form-control" required>
                @error('class_code') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="semester">{{ trans('Semester') }} *</label>
                <input type="text" name="semester" class="form-control" required>
                @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="class_description">{{ trans('Class Description') }}</label>
                <textarea name="class_description" class="form-control"></textarea>
                @error('class_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <h4>{{ trans('Subjects') }}</h4>
            <div id="subjects-container">
                <div class="subject-row">
                    <div class="form-group col-md-2">
                        <label>{{ trans('Subject Code') }} *</label>
                        <input type="text" name="subjects[0][subject_code]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ trans('Subject Name') }} *</label>
                        <input type="text" name="subjects[0][subject_name]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ trans('Teacher') }} *</label>
                        <select name="subjects[0][teacher_id]" class="form-control" required>
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ trans('Day') }} *</label>
                        <select name="subjects[0][day]" class="form-control" required>
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
                        <input type="number" name="subjects[0][total_credit]" class="form-control" required min="1" max="10">
                    </div>
                    <div class="form-group col-md-1">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-danger remove-subject" style="margin-top: 5px;">-</button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-subject" class="btn btn-success mt-2">+</button>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ trans('Save') }}</button>
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
        let subjectIndex = 1;

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
