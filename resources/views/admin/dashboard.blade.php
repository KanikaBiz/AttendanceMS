@extends('admin.layouts.master_layout')

@push('styles')
@endpush

@section('breadcrumb', trans('global.dashboard'))

@section('pagetitle', trans('global.dashboard'))

@section('content')
@section('breadcrumb_title', trans('Dashboard'))
@section('breadcrumb_pagename', trans('Manage Dashboard'))


@endsection

@push('scripts')
@endpush
