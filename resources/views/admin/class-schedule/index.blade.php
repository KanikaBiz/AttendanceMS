@extends('admin.layouts.master_layout')

@push('styles')
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb_title', trans('Manage Class Schedule'))
@section('breadcrumb_pagename', trans('Class Schedule List'))
@section('breadcrumb', trans('Class Schedule List'))

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ trans('Class Schedule List') }}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.class-schedules.create') }}" class="btn btn-primary">{{ trans('Add Class Schedule') }}</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ trans('Class Name') }}</th>
                    <th>{{ trans('Class Code') }}</th>
                    <th>{{ trans('Semester') }}</th>
                    <th>{{ trans('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->class_name }}</td>
                        <td>{{ $schedule->class_code }}</td>
                        <td>{{ $schedule->semester }}</td>
                        <td>
                            <a href="{{ route('admin.class-schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">{{ trans('Edit') }}</a>
                            <form action="{{ route('admin.class-schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ trans('Are you sure?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">{{ trans('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
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
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
    </script>
@endpush
