@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('content')
    <!-- page -->
    <div class="page">
        <div class="page-inner">
            <!-- page-title-bar -->
            <header class="page-title-bar">
                <!-- breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="{{ route('admin.dashboard') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Dashboard</a>
                        </li>
                    </ol>
                </nav>
                <!-- end breadcrumb -->
                <div class="d-md-flex align-items-md-start">
                    <h1 class="page-title mr-sm-auto"> Media Library </h1>
                </div>
            </header>
            <!-- end page-title-bar -->
            <!-- page-section -->
            <div class="page-section">
                <!-- card -->
                <div class="card card-fluid">
                    <div class="card-body">
                        <iframe id="iframe" src="/admin/laravel-filemanager?editor=src&type=Images" style="width: 100%; min-height: 700px; overflow: hidden; border: none;"></iframe>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
    <!-- end page -->
@endsection
