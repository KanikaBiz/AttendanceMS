@extends('admin.layouts.master_layout')

@push('styles')
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Attendance'))
@section('breadcrumb_pagename', trans('Attendance List'))
@section('breadcrumb', trans('Attendance List'))

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ trans('Attendance List') }}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.attendances.create') }}" class="btn btn-primary">{{ trans('Record Attendance') }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <select name="class_id" id="class_id" class="form-control">
                    <option value="">{{ trans('Select Class') }}</option>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}">{{ $schedule->class_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="subject_id" id="subject_id" class="form-control">
                    <option value="">{{ trans('Select Subject') }}</option>
                    @foreach ($schedules as $schedule)
                        @foreach ($schedule->subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="col-md-1">
                <button type="button" id="filter-btn" class="btn btn-primary">{{ trans('Filter') }}</button>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered" id="attendanceTable">
            <thead>
                <tr>
                    <th>{{ trans('Class') }}</th>
                    <th>{{ trans('Subject') }}</th>
                    <th>{{ trans('Student') }}</th>
                    <th>{{ trans('Date') }}</th>
                    <th>{{ trans('Status') }}</th>
                    <th>{{ trans('Remarks') }}</th>
                    <th>{{ trans('Actions') }}</th>
                </tr>
            </thead>
            <tbody id="attendance-body">
                @foreach ($schedules as $schedule)
                    @foreach ($schedule->subjects as $subject)
                        @foreach ($subject->attendances as $attendance)
                            <tr>
                                <td>{{ $schedule->class_name }}</td>
                                <td>{{ $subject->subject_name }}</td>
                                <td>{{ $attendance->student->name }}</td>
                                <td>{{ $attendance->attendance_date }}</td>
                                <td>{{ $attendance->status }}</td>
                                <td>{{ $attendance->remarks }}</td>
                                <td>
                                    <a href="{{ route('admin.attendances.edit', $attendance->id) }}" class="btn btn-sm btn-warning">{{ trans('Edit') }}</a>
                                    <button type="button" class="btn btn-sm btn-danger delete-attendance" data-id="{{ $attendance->id }}" data-url="{{ route('admin.attendances.destroy', $attendance->id) }}">{{ trans('Delete') }}</button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>

    <script>
        $('#filter-btn').on('click', function () {
            const classId = $('#class_id').val();
            const subjectId = $('#subject_id').val();
            const date = $('#date').val();

            $.ajax({
                url: '{{ route('admin.attendances.index') }}',
                type: 'GET',
                data: {
                    class_id: classId,
                    subject_id: subjectId,
                    date: date
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response); // Debug the response
                    $('#attendance-body').empty();
                    if (response.schedules && response.schedules.length > 0) {
                        response.schedules.forEach(schedule => {
                            if (schedule.subjects && schedule.subjects.length > 0) {
                                schedule.subjects.forEach(subject => {
                                    if (subject.attendances && subject.attendances.length > 0) {
                                        subject.attendances.forEach(attendance => {
                                            $('#attendance-body').append(`
                                                <tr>
                                                    <td>${schedule.class_name}</td>
                                                    <td>${subject.subject_name}</td>
                                                    <td>${attendance.student.name}</td>
                                                    <td>${attendance.attendance_date}</td>
                                                    <td>${attendance.status}</td>
                                                    <td>${attendance.remarks || ''}</td>
                                                    <td>
                                                        <a href="{{ route('admin.attendances.edit', ':id') }}".replace(':id', attendance.id)" class="btn btn-sm btn-warning">{{ trans('Edit') }}</a>
                                                        <button type="button" class="btn btn-sm btn-danger delete-attendance" data-id="${attendance.id}" data-url="{{ route('admin.attendances.destroy', ':id') }}".replace(':id', attendance.id)">{{ trans('Delete') }}</button>
                                                    </td>
                                                </tr>
                                            `);
                                        });
                                    }
                                });
                            }
                        });
                    } else {
                        $('#attendance-body').append('<tr><td colspan="7">{{ trans('No records found') }}</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Debug the error
                    toastr.error('{{ trans("Error fetching attendance data.") }}');
                }
            });
        });

        $(document).on('click', '.delete-attendance', function () {
            var url = $(this).data('url');
            Swal.fire({
                title: '{{ trans("Are you sure?") }}',
                text: "{{ trans('You will not be able to recover this attendance!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans("Yes, delete it!") }}',
                cancelButtonText: '{{ trans("Cancel") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            toastr.success(response.message);
                            $('#filter-btn').click(); // Refresh the table
                        },
                        error: function (xhr) {
                            toastr.error('{{ trans("Error deleting attendance.") }}');
                        }
                    });
                }
            });
        });

        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
    </script>
@endpush
