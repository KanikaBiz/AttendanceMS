@extends('admin.layouts.master_layout')

@push('styles')
    <link href="{{ assetUrl() }}assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/toggle.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
    {{-- <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datepicker/datepicker3.css"> --}}
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/daterangepicker/daterangepicker.css">
    {{-- daterangepicker --}}
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Attendance'))
@section('breadcrumb_pagename', trans('Attendance List'))
@section('breadcrumb', trans('Manage Attendance'))

<div class="card">
    <div class="card-header">
        <h4 class="mb-0 text-primary">
            <i class="bx bxs-check-circle me-1 font-22 text-primary"></i>{{ trans('Check Attendance') }}
        </h4>
    </div>
    <div class="card-body">
        <form id="attendanceFilterForm" method="GET" action="{{ route('admin.attendance.index') }}">
            {{ csrf_field() }}
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="class_id">{{ trans('Class') }}</label>
                    <select name="class_id" id="class_id" class="form-control select2" required>
                        <option value="">{{ trans('global.select') }} {{ trans('Class') }}</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }} ({{ $class->code }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="teacher_id">{{ trans('Teacher') }}</label>
                    <select name="teacher_id" id="teacher_id" class="form-control select2">
                        <option value="">{{ trans('global.select') }} {{ trans('Teacher') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="subject_id">{{ trans('Subject') }}</label>
                    <select name="subject_id" id="subject_id" class="form-control select2">
                        <option value="">{{ trans('global.select') }} {{ trans('Subject') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="attendance_date">{{ trans('Attendance Date') }}</label>
                    <input type="text" name="attendance_date" id="attendance_date" class="form-control attendance-datepicker" value="{{ request('attendance_date') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ trans('Filter') }}</button>
        </form>

        <div class="table-responsive mt-4">
            <form id="attendanceForm" action="{{ route('admin.attendance.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="class_id" value="{{ request('class_id') }}">
                <input type="hidden" name="subject_teacher_id" id="subject_teacher_id">
                <input type="hidden" name="attendance_date" value="{{ request('attendance_date') }}">
                <table id="attendanceTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('Student ID') }}</th>
                            <th>{{ trans('Student Name') }}</th>
                            <th>{{ trans('Attendance Status') }}</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceList">
                        @if (request('class_id') && request('attendance_date') && $students)
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <select name="attendance[{{ $student->id }}]" class="form-control">
                                            <option value="present" {{ $student->attendance_status == 'present' ? 'selected' : '' }}>{{ trans('Present') }}</option>
                                            <option value="absent" {{ $student->attendance_status == 'absent' ? 'selected' : '' }}>{{ trans('Absent') }}</option>
                                            <option value="late" {{ $student->attendance_status == 'late' ? 'selected' : '' }}>{{ trans('Late') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if (request('class_id') && request('attendance_date') && $students)
                    <button type="submit" class="btn btn-success mt-3">{{ trans('Save Attendance') }}</button>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/jszip/jszip.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>
    {{-- <script src="{{ assetUrl() }}assets/backend/plugins/datepicker/bootstrap-datepicker.js"></script> --}}
    <script src="{{ assetUrl() }}assets/backend/plugins/daterangepicker/daterangepicker.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('.select2').select2({
                placeholder: '{{ trans('global.select') }}',
                allowClear: true,
            });

            // Initialize Bootstrap Datepicker
            $('.attendance-datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: 'bottom auto', // Prevent overlap
                zIndexOffset: 1001 // Ensure it appears above other elements
            });

            // Initialize DataTable
            $('#attendanceTable').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print'],
                ordering: false,
            }).buttons().container().appendTo('#attendanceTable_wrapper .col-md-6:eq(0)');

            // Load teachers based on class selection
            $('#class_id').on('change', function () {
                let classId = $(this).val();
                if (classId) {
                    $.ajax({
                        url: '{{ route('admin.attendance.getTeachers') }}',
                        type: 'GET',
                        data: { class_id: classId },
                        success: function (res) {
                            console.log('Teachers Response:', res); // Debug response
                            $('#teacher_id').empty().append('<option value="">{{ trans('global.select') }} {{ trans('Teacher') }}</option>');
                            if (res.teachers && res.teachers.length > 0) {
                                $.each(res.teachers, function (key, teacher) {
                                    $('#teacher_id').append('<option value="' + teacher.id + '">' + teacher.name + '</option>');
                                });
                            } else {
                                toastr.warning('No teachers found for this class');
                            }
                            $('#subject_id').empty().append('<option value="">{{ trans('global.select') }} {{ trans('Subject') }}</option>');
                            $('#subject_teacher_id').val('');
                        },
                        error: function (xhr) {
                            console.error('Error fetching teachers:', xhr); // Debug error
                            toastr.error('Error fetching teachers: ' + xhr.statusText);
                        }
                    });
                } else {
                    $('#teacher_id').empty().append('<option value="">{{ trans('global.select') }} {{ trans('Teacher') }}</option>');
                    $('#subject_id').empty().append('<option value="">{{ trans('global.select') }} {{ trans('Subject') }}</option>');
                    $('#subject_teacher_id').val('');
                }
            });

            // Load subjects based on teacher and class selection
            $('#teacher_id').on('change', function () {
                let teacherId = $(this).val();
                let classId = $('#class_id').val();
                if (teacherId && classId) {
                    $.ajax({
                        url: '{{ route('admin.attendance.getSubjects') }}',
                        type: 'GET',
                        data: { class_id: classId, teacher_id: teacherId },
                        success: function (res) {
                            console.log('Subjects Response:', res); // Debug response
                            $('#subject_id').empty().append('<option value="">{{ trans('global.select') }} {{ trans('Subject') }}</option>');
                            if (res.subjects && res.subjects.length > 0) {
                                $.each(res.subjects, function (key, subject) {
                                    $('#subject_id').append('<option value="' + subject.id + '" data-subject-teacher-id="' + subject.subject_teacher_id + '">' + subject.name + '</option>');
                                });
                            } else {
                                toastr.warning('No subjects found for this teacher');
                            }
                            $('#subject_teacher_id').val('');
                        },
                        error: function (xhr) {
                            console.error('Error fetching subjects:', xhr); // Debug error
                            toastr.error('Error fetching subjects: ' + xhr.statusText);
                        }
                    });
                } else {
                    $('#subject_id').empty().append('<option value="">{{ trans('global.select') }} {{ trans('Subject') }}</option>');
                    $('#subject_teacher_id').val('');
                }
            });

            // Set subject_teacher_id when subject is selected
            $('#subject_id').on('change', function () {
                let subjectTeacherId = $(this).find(':selected').data('subject-teacher-id');
                $('#subject_teacher_id').val(subjectTeacherId || '');
            });

            // Save attendance
            $('#attendanceForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.btn-success').html('Processing...').prop('disabled', true);
                    },
                    success: function (res) {
                        toastr.success(res.success);
                        $('.btn-success').html('{{ trans('Save Attendance') }}').prop('disabled', false);
                        $('#attendanceFilterForm').submit(); // Refresh table
                    },
                    error: function (xhr) {
                        console.error('Error saving attendance:', xhr); // Debug error
                        toastr.error('Error saving attendance: ' + xhr.statusText);
                        $('.btn-success').html('{{ trans('Save Attendance') }}').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
