@extends('admin.layouts.app')

@section('title', 'Sitemap Settings')

@section('content')
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <header class="page-title-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Dashboard
                            </a>
                        </li>
                    </ol>
                </nav>
            </header>
            <div class="page-section">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-fluid">
                            <h6 class="card-header"> Settings </h6><!-- .nav -->
                            <nav class="nav nav-tabs flex-column border-0">
                                <a href="{{ route('admin.settings.index', 'general') }}" class="nav-link">General Settings</a>
                                <a href="{{ route('admin.settings.index', 'sitemap') }}" class="nav-link active">Sitemap Settings</a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card card-fluid">
                            <h6 class="card-header">Sitemap Generate</h6>
                            <div class="card-body">
                                <div class="card card-fluid">
                                    @php
                                        $html = '  OOPS! Sitemap not found. Please generated sitemap by clicking bellow button.';
                                        if (file_exists(public_path('sitemap.xml'))) {
                                            $html = file_get_contents(public_path('sitemap.xml'));
                                        }
                                    @endphp
                                    <div class="card-header">Last Generated Data</div>
                                    <pre id="aceEditor" style="height:400px;">{!! $html !!}</pre>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a href="{{ route('admin.settings.sitemap') }}" class="btn btn-primary text-nowrap ml-auto">Sitemap Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.page-inner -->
    </div>
    <!-- /.page -->
@endsection

@push('head-styles')
    <link rel="stylesheet" href="{{ asset('admin/vendor/select2/css/select2.min.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }
        .select2-search__field {
            width: 100% !important;
        }
    </style>
@endpush

@push('plugin_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $("#select2-tagging").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    </script>
@endpush
