@extends('admin.layouts.app')

@section('title', 'Edit Post')

@section('content')
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <!-- .breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="{{ route('admin.dashboard') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Dashboard</a>
                        </li>
                    </ol>
                </nav>
                <!-- /.breadcrumb -->
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                    <h1 class="page-title mr-sm-auto">Edit Post</h1>
                </div>
                <!-- /title and toolbar -->
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </header>
            <!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <form id="blog-form" method="POST" action="{{ route('admin.blogs.update', $blog->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="card card-fluid">
                                <div class="card-header">
                                    <h6 class="card-header-title mb-0">Post information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label" for="title">Title</label>
                                        <input class="form-control" id="title" name="title" type="text" placeholder="Post title" value="{{ $blog->title }}">
                                        <div id="edit-slug-box" class="mt-2 @if(!$blog->slug) d-none @endif">
                                            <strong>Permalink:</strong>
                                            <span id="sample-permalink">
                                                <a href="{{ route('web.post', $blog->slug) }}" target="_blank">{{ $app_url }}/<span id="editable-post-name">{{ $blog->slug }}</span></a>
                                                <span id="editable-post-input" class="d-none">
                                                    <input type="text" name="slug" id="slug" value="{{ $blog->slug }}">
                                                </span>
                                            </span>
                                            <span id="edit-slug-buttons">
                                                <button type="button" class="btn btn-secondary btn-xs" id="edit-slug-btn" aria-label="Edit permalink">Edit</button>
                                                <button type="button" class="btn btn-subtle-success btn-xs d-none" id="save-slug-btn" aria-label="Edit permalink">Save</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="editor">Content</label>
                                        <textarea id="editor" rows="10" name="description">{!! $blog->description !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-fluid mb-4">
                                <div class="card-header">
                                    <h6 class="card-heading mb-0">SEO Meta Details</h6>
                                </div>
                                <div class="card-body text-gray-700">
                                    <div class="form-group">
                                        <label class="d-flex justify-content-between" for="meta_title">
                                            <span>SEO Title</span>
                                            <span class="text-muted">Max 60 characters used</span>
                                        </label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="SEO Title" value="{{ $blog->meta_title }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="d-flex justify-content-between" for="meta_description">
                                            <span>Meta Description</span>
                                            <span class="text-muted">Max 160 characters used</span>
                                        </label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Meta Description">{{ $blog->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="select2-tagging">Meta Keywords</label>
                                        <select id="select2-tagging" class="form-control" name="meta_keywords[]" multiple>
                                            @if ($blog->meta_keywords)
                                                @foreach(StringToArray($blog->meta_keywords, ', ') as $keyword)
                                                    <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card card-fluid mb-4">
                                <div class="card-header">
                                    <h6 class="card-heading mb-0">Publish</h6>
                                </div>
                                <div class="card-body text-gray-700">
                                    <div class="d-flex mb-4 justify-content-end">
                                        <a href="{{ route('web.post', $blog->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Preview Changes</a>
                                    </div>
                                    <hr class="bg-gray-500">
                                    <div class="mb-3">
                                        Status: <strong id="status-text">
                                            @if($blog->status === '1')
                                                Published
                                            @elseif($blog->status === '2')
                                                Draft
                                            @else
                                                Pending Review
                                            @endif
                                        </strong><a class="ms-2 text-sm collapsed" data-toggle="collapse" href="#collapseStatus" role="button" aria-expanded="false" aria-controls="collapseStatus">Edit</a>
                                        <div class="collapse" id="collapseStatus">
                                            <div class="form-group py-2">
                                                <select id="select-status" class="custom-select" name="status" aria-label="Default select example" onchange="changeStatus(this)">
                                                    <option value="1" @if($blog->status === '1') selected @endif>Published</option>
                                                    <option value="2" @if($blog->status === '2') selected @endif>Draft</option>
                                                    <option value="3" @if($blog->status === '3') selected @endif>Pending Review</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        Visibility: <strong id="visibility-text">
                                            @if ($blog->visibility === '1')
                                                Public
                                            @else
                                                Private
                                            @endif
                                        </strong><a class="ms-2 text-sm collapsed" data-toggle="collapse" href="#collapseVisibility" role="button" aria-expanded="false" aria-controls="collapseVisibility">Edit</a>
                                        <div class="collapse" id="collapseVisibility">
                                            <div class="form-group py-2">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="visibility" id="visibility1" onchange="changeVisibility(1)" value="1" @if($blog->visibility === '1') checked @endif>
                                                    <label class="custom-control-label" for="visibility1">Public</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="visibility" id="visibility2" onchange="changeVisibility(2)" value="2" @if($blog->visibility === '2') checked @endif>
                                                    <label class="custom-control-label" for="visibility2">Private</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center p-0 mb-2">
                                        <span>Featured Post</span>
                                        <label class="switcher-control">
                                            <input type="checkbox" class="switcher-input" name="is_featured" @if ($blog->is_featured) checked @endif>
                                            <span class="switcher-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer justify-content-end px-3 py-2">
                                    <button type="button" class="btn btn-primary" onclick="handlePublish('1')">Update</button>
                                </div>
                            </div>

                            <div class="card card-fluid mb-4">
                                <div class="card-header">
                                    <h6 class="card-heading mb-0">Categories</h6>
                                </div>
                                <div class="card-body px-4">
                                    <div class="form-group mb-3">
                                        @foreach($categories as $category)
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}" @if(IsCollectionValueExist($blog->categories, $category->id)) checked @endif>
                                                <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="btn-link" href="{{ route('admin.categories.index') }}">+ Add New Category</a>
                                </div>
                            </div>

                            <div class="card card-fluid mb-4">
                                <div class="card-header">
                                    <h6 class="card-heading mb-0">Tags</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <select id="select-tag" class="form-control" name="tags[]" multiple="multiple">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}" @if(IsCollectionValueExist($blog->tags, $tag->id)) selected @endif>{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <a class="btn-link" href="{{ route('admin.tags.index') }}">+ Add New Tag</a>
                                </div>
                            </div>

                            <div class="card card-fluid mb-4">
                                <div class="card-header">
                                    <h6 class="card-heading mb-0">Featured image</h6>
                                </div>
                                <div class="card-body">
                                    <div id="lfm-input" class="form-group mb-3 @if($blog->featured_image) d-none @endif">
                                        <div class="custom-file">
                                            <input type="text" class="custom-file-input" name="featured_image" id="featured_image" value="{{ $blog->featured_image }}">
                                            <label class="custom-file-label" for="featured_image">Choose files</label>
                                        </div>
                                    </div>
                                    <div id="lfm-preview" class="card card-figure @if(!$blog->featured_image) d-none @endif">
                                        <figure class="figure">
                                            <div class="figure-img">
                                                <img class="img-fluid" src="{{ $blog->featured_image }}" alt="{{ $blog->alt_text }}">
                                            </div>
                                            <figcaption class="figure-caption">
                                                <ul class="list-inline d-flex text-muted mb-0">
                                                    @php
                                                        if ($blog->featured_image) {
                                                            $photoExplode = StringToArray($blog->featured_image, '/');
                                                            $photoName = $photoExplode[count($photoExplode) - 1];
                                                        }
                                                    @endphp
                                                    <li id="preview-name" class="list-inline-item text-truncate mr-auto">{{ $photoName ?? 'None' }}</li>
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
                                    <div class="collapse" id="collapseAltText">
                                        <hr class="mt-3 mb-0" />
                                        <div class="form-group">
                                            <label class="col-form-label" for="alt_text">Alt Text</label>
                                            <input class="form-control" id="alt_text" name="alt_text" type="text" placeholder="EX: Laravel Development" value="{{ $blog->alt_text }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-fluid mb-4">
                                <div class="card-header">
                                    <h6 class="card-heading mb-0">Set Clickable URL</h6>
                                </div>
                                <div class="card-body text-gray-700">
                                    <div class="form-group">
                                        <label class="col-form-label" for="click_url_1">Click URL 1</label>
                                        <input type="text" class="form-control" id="click_url_1" name="click_url_1" placeholder="Click URL" value="{{ $click_urls ? $click_urls->click_url_1 : null }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="click_url_2">Click URL 2</label>
                                        <input type="text" class="form-control" id="click_url_2" name="click_url_2" placeholder="Click URL" value="{{ $click_urls ? $click_urls->click_url_2 : null }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="click_url_3">Click URL 3</label>
                                        <input type="text" class="form-control" id="click_url_3" name="click_url_3" placeholder="Click URL" value="{{ $click_urls ? $click_urls->click_url_3 : null }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="click_url_4">Click URL 4</label>
                                        <input type="text" class="form-control" id="click_url_4" name="click_url_4" placeholder="Click URL" value="{{ $click_urls ? $click_urls->click_url_4 : null }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.page-section -->
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
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/9c8eaxi8zutqzgs3cdz7hjzv8f6j1eo0htyi5ijyfm8i95r4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@push('scripts')
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount autoresize',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

            // extended_valid_elements : 'mycustomblock[id],mycustominline',
            // custom_elements : 'mycustomblock,~mycustominline',
            file_picker_callback (callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = '/admin/laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype === 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinymce.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Media Manager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });

        $("#select-tag").select2({
            tokenSeparators: [',', ' ']
        });

        $("#select2-tagging").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        function changeStatus(event) {
            setStatusText(event.value);
        }

        function setStatusText (value) {
            const statusText = document.getElementById('status-text');
            if (value === '1') {
                statusText.innerText = 'Published ';
            } else if (value === '2') {
                statusText.innerText = 'Draft ';
            } else {
                statusText.innerText = 'Pending Review ';
            }
        }

        function changeVisibility(id) {
            const visibilityText = document.getElementById('visibility-text');
            if (id === 1) {
                visibilityText.innerText = 'Public '
            } else if (id === 2) {
                visibilityText.innerText = 'Private '
            }
        }

        function handlePublish (status) {
            const selectStatus = document.getElementById('select-status');
            selectStatus.value = status;
            setStatusText(status);
            if (selectStatus.value === status) {
                document.getElementById('blog-form').submit();
            }
        }

        function handleTitle (event) {
            const slugBox = document.getElementById('edit-slug-box');
            const editAbleText = document.getElementById('editable-post-name');
            const slugInput = document.getElementById('slug');
            let altText = document.getElementById('alt_text');
            let value = event.value;
            let generateSlugValue = value.toLowerCase().split(',').join('').replace(/\s/g,"-");
            if (value !== '') {
                if (slugBox.classList.contains('d-none')) slugBox.classList.remove('d-none');
                editAbleText.innerText = generateSlugValue;
                slugInput.value = generateSlugValue;
                altText.value = value;
            } else {
                if (!slugBox.classList.contains('d-none')) slugBox.classList.add('d-none');
                editAbleText.innerText = '';
                slugInput.value = '';
                altText.value = '';
            }
        }

        function editSlug (type) {
            const editAbleText = document.getElementById('editable-post-name');
            const editAbleInput = document.getElementById('editable-post-input');
            const editButton = document.getElementById('edit-slug-btn');
            const saveButton = document.getElementById('save-slug-btn');

            if (type === 'edit-slug-btn') {
                editButton.classList.add('d-none');
                saveButton.classList.remove('d-none');
                editAbleText.classList.add('d-none');
                editAbleInput.querySelector('input').value = editAbleText.innerText;
                editAbleInput.classList.remove('d-none');
            } else {
                saveButton.classList.add('d-none');
                editButton.classList.remove('d-none');
                editAbleText.classList.remove('d-none');
                editAbleInput.classList.add('d-none');
                editAbleText.innerText = editAbleInput.querySelector('input').value;
            }
        }

        document.getElementById('edit-slug-buttons').addEventListener('click', function (event) {
            const button = event.target;
            editSlug(button.id);
        });

        function lfm (id, type, options) {
            let button = document.getElementById(id);
            button.addEventListener('click', function () {
                let route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                let lfmInput = document.getElementById('lfm-input');
                let lfmPreview = document.getElementById('lfm-preview');
                let targetPreview = lfmPreview.querySelector('img');
                let targetName = lfmPreview.querySelector('#preview-name');

                window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    // set the value of the desired input to image url
                    button.value = items.map(function (item) {
                        return item.url;
                    }).join(',');

                    button.dispatchEvent(new Event('change'));
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

        lfm('featured_image', 'Images', {prefix: '/admin/laravel-filemanager'});

        function handleMediaManager() {
            let button = document.getElementById('featured_image');
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
