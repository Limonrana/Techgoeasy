@extends('admin.layouts.app')

@section('title', 'General Settings')

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
                                <a href="{{ route('admin.settings.index', 'general') }}" class="nav-link active">General Settings</a>
                                <a href="{{ route('admin.settings.index', 'sitemap') }}" class="nav-link">Sitemap Settings</a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card card-fluid">
                            <h6 class="card-header">General Settings</h6>
                            <div class="card-body">
                                <!-- form -->
                                <form method="POST" action="{{ route('admin.settings.update', 'general') }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- .form-group -->
                                            <div class="form-group">
                                                <label for="site_title">Site Title</label>
                                                <input type="text" id="site_title" name="site_title" value="{{ $option ? $option['site_title'] : config('app.name') }}" class="form-control">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- .form-group -->
                                            <div class="form-group">
                                                <label for="tagline">Tagline</label>
                                                <input type="text" id="tagline" name="tagline" value="{{ $option ? $option['tagline'] : null }}" class="form-control">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- .form-group -->
                                            <div class="form-group">
                                                <label for="meta_title">SEO Meta Title</label>
                                                <input type="text" id="meta_title" name="meta_title" value="{{ $option ? $option['meta_title'] : config('app.name') }}" class="form-control">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="select2-tagging">SEO Meta Keywords</label>
                                                <select id="select2-tagging" class="form-control" name="meta_keywords[]" multiple>
                                                    @if ($option)
                                                        @foreach($option['meta_keywords'] as $keyword)
                                                            <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="meta_description">SEO Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="4">{!! $option ? $option['meta_description'] : null !!}</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                    <hr>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary text-nowrap ml-auto">Update</button>
                                    </div>
                                </form>
                                <!-- /form -->
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
