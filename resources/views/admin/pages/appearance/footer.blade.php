@extends('admin.layouts.app')

@section('title', 'Customize Footer')

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
                            @include('admin.pages.appearance.menu-bar', ['active' => 'footer'])
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card card-fluid">
                            <h6 class="card-header">Header Content</h6>
                            <div class="card-body">
                                <!-- form -->
                                <form method="POST" action="{{ route('admin.customize.update', 'footer') }}">
                                    @csrf
                                    @method('put')
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="name">Footer Logo</label>
                                        <div id="lfm-input" class="fileinput-dropzone @if ($isLogo) d-none @endif">
                                            <span>Drop file or click to upload.</span><br>
                                            <span style="font-size: 10px;">Max file size 1MB</span><br>
                                            <span style="font-size: 10px;">Recommended Size 150px * 25px</span>
                                            <input id="logo-upload" type="hidden" name="logo" value="{{ $option ? $option['logo'] : null }}">
                                        </div>
                                        <div id="lfm-preview" class="fileinput-dropzone @if (!$isLogo) d-none @endif">
                                            <div class="card card-figure">
                                                <figure class="figure">
                                                    <div class="figure-img">
                                                        <img class="img-fluid" src="{{ $option ? $option['logo'] : null }}" alt="logo" style="height: 30px;">
                                                    </div>
                                                    <figcaption class="figure-caption">
                                                        <ul class="list-inline d-flex text-muted mb-0">
                                                            <li id="preview-name" class="list-inline-item text-truncate mr-auto">Footer Logo</li>
                                                            <li class="list-inline-item">
                                                                <a href="#collapseAltText" class="collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseStatus">
                                                                    Edit Info
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="#" id="remove-preview">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseAltText">
                                            <hr class="mt-3 mb-0" />
                                            <div class="form-group">
                                                <label class="col-form-label" for="alt_text">Alt Text</label>
                                                <input class="form-control" id="alt_text" name="alt_text" type="text" placeholder="EX: Laravel Development" value="{{ $option ? $option['alt_text'] : null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- .form-group -->
                                            <div class="form-group">
                                                <label for="logo_width">Logo Width</label>
                                                <input type="text" id="logo_width" name="logo_width" value="{{ $option ? $option['logo_width'] : '150' }}" class="form-control">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- .form-group -->
                                            <div class="form-group">
                                                <label for="logo_height">Logo Height</label>
                                                <input type="text" id="logo_height" name="logo_height" value="{{ $option ? $option['logo_height'] : '30' }}" class="form-control">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="about_company">About Company</label>
                                        <textarea type="text" id="about_company" name="about_company" rows="4" class="form-control">{{ $option ? $option['about_company'] : null }}</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="copy_right_text">Copy Right text</label>
                                        <textarea type="text" id="copy_right_text" name="copy_right_text" rows="2" class="form-control">{{ $option ? $option['copy_right_text'] : null }}</textarea>
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

@push('plugin_scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
@endpush

@push('scripts')
    <script>
        function lfm (id, type, options) {
            let lfmInput = document.getElementById(id);
            let logoInput = lfmInput.querySelector('#logo-upload');
            lfmInput.addEventListener('click', function () {
                let route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                let lfmPreview = document.getElementById('lfm-preview');
                let targetPreview = lfmPreview.querySelector('img');
                let targetName = lfmPreview.querySelector('#preview-name');

                window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    // set the value of the desired input to image url
                    logoInput.value = items.map(function (item) {
                        return item.url;
                    }).join(',');

                    logoInput.dispatchEvent(new Event('change'));
                    // set or change the preview image src and image name
                    items.forEach(function (item) {
                        targetPreview.src = item.url;
                        targetName.innerText = item.name;
                    });
                    // trigger change event
                    targetPreview.dispatchEvent(new Event('change'));
                    if (!lfmInput.classList.contains('d-none')) lfmInput.classList.add('d-none');
                    if (lfmPreview.classList.contains('d-none')) lfmPreview.classList.remove('d-none');
                };
            });
        };

        lfm('lfm-input', 'Images', {prefix: '/admin/laravel-filemanager'});

        function handleMediaManager() {
            let button = document.getElementById('logo-upload');
            let lfmInput = document.getElementById('lfm-input');
            let lfmPreview = document.getElementById('lfm-preview');
            button.value = '';
            if (!lfmPreview.classList.contains('d-none')) lfmPreview.classList.add('d-none');
            if (lfmInput.classList.contains('d-none')) lfmInput.classList.remove('d-none');
        }

        document.querySelector('#remove-preview').addEventListener('click', function (event) {
            event.preventDefault();
            handleMediaManager();
        });
    </script>
@endpush
