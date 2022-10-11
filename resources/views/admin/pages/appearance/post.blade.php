@extends('admin.layouts.app')

@section('title', 'Customize Post')

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
                            <h6 class="card-header"> Customize </h6><!-- .nav -->
                            @include('admin.pages.appearance.menu-bar', ['active' => 'post'])
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card card-fluid">
                            <h6 class="card-header">Post Page Ads</h6>
                            <!-- form -->
                            <form method="POST" action="{{ route('admin.customize.update', 'post') }}">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <fieldset>
                                        <legend>Banner Ads</legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="banner_script_1">Ads Script</label>
                                                        <textarea class="form-control" id="banner_script_1" name="banner_script_1" rows="4" placeholder="Ads Script">{{ $option ? $option['banner_script_1'] : null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="banner_script_2">Ads Script</label>
                                                        <textarea class="form-control" id="banner_script_2" name="banner_script_2" rows="4" placeholder="Ads Script">{{ $option ? $option['banner_script_2'] : null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="banner_script_3">Ads Script</label>
                                                        <textarea class="form-control" id="banner_script_3" name="banner_script_3" rows="4" placeholder="Ads Script">{{ $option ? $option['banner_script_3'] : null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="card-body">
                                    <fieldset>
                                        <legend>Right Sidebar Ads</legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="sidebar_script_1">Ads Script</label>
                                                        <textarea class="form-control" id="sidebar_script_1" name="sidebar_script_1" rows="4" placeholder="Ads Script">{{ $option ? $option['sidebar_script_1'] : null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="sidebar_script_2">Ads Script</label>
                                                        <textarea class="form-control" id="sidebar_script_2" name="sidebar_script_2" rows="4" placeholder="Ads Script">{{ $option ? $option['sidebar_script_2'] : null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="sidebar_script_3">Ads Script</label>
                                                        <textarea class="form-control" id="sidebar_script_3" name="sidebar_script_3" rows="4" placeholder="Ads Script">{{ $option ? $option['sidebar_script_3'] : null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <hr>
                                <div class="form-actions p-3">
                                    <button type="submit" class="btn btn-primary text-nowrap ml-auto">Update</button>
                                </div>
                            </form>
                            <!-- /form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.page-inner -->
    </div>
    <!-- /.page -->
@endsection

@push('scripts')
    <script></script>
@endpush
