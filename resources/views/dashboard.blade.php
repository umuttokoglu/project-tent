@extends('layout.app')

@section('page-title') {{ __('admin/page-title.dashboard') }} @endsection

@section('breadcrumb')

@endsection

@section('content')

@endsection

@section('page-css')
    <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
@endsection
