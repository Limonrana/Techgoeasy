@extends('admin.layouts.app')

@section('title', 'Tags')

@section('content')
    <!-- .page -->
    <div class="page">
        @if (count($tags) > 0)
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
                    </nav><!-- /.breadcrumb -->
                    <!-- floating action -->
                    <button type="button" class="btn btn-success btn-floated" data-toggle="modal" data-target="#tagAdd">
                        <span class="fa fa-plus"></span>
                    </button>
                    <!-- /floating action -->
                    <!-- title and toolbar -->
                    <div class="d-md-flex align-items-md-start">
                        <h1 class="page-title mr-sm-auto"> Tags </h1>
                        <!-- .btn-toolbar -->
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
                    <!-- .card -->
                    <div class="card card-fluid">
                        <!-- .card-body -->
                        <div class="card-body" style="padding-top: 2.5rem !important;">
                            <!-- .form-group -->
                            <div class="form-group">
                                <!-- .input-group -->
                                <form class="input-group input-group-alt" method="GET" action="{{ route('admin.tags.index') }}">
                                    <!-- .input-group -->
                                    <div class="input-group has-clearable">
                                        <button type="button" class="close" aria-label="Close" onclick="removeQueryString()">
                                            <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                                        </button>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <span class="oi oi-magnifying-glass"></span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="q" placeholder="Search record" value="{{ $q }}" />
                                    </div>
                                    <!-- /.input-group -->
                                    <!-- .input-group-prepend -->
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                    <!-- /.input-group-prepend -->
                                </form>
                                <!-- /.input-group -->
                            </div>
                            <!-- /.form-group -->
                            <!-- .table-responsive -->
                            <div class="text-muted"> Showing {{ $tags->currentPage() === $tags->lastPage() ? $tags->total() : $tags->currentPage() * $tags->perPage() }} of {{ $tags->total() }} entries </div>
                            <div class="table-responsive">
                                <!-- .table -->
                                <table class="table">
                                    <!-- thead -->
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="min-width:120px">SL</th>
                                            <th> Slug </th>
                                            <th> Created By </th>
                                            <th> Updated By </th>
                                            <th> Created At </th>
                                            <th> Last Updated </th>
                                            <th style="width:100px; min-width:100px;"> &nbsp; </th>
                                        </tr>
                                    </thead>
                                    <!-- /thead -->
                                    <!-- tbody -->
                                    <tbody>
                                        @foreach($tags as $key => $tag)
                                            <!-- tr -->
                                            <tr>
                                                <td class="align-middle col-checker">
                                                    {{ $tags->firstItem() + $key }}.
                                                </td>
                                                <td>
                                                    <a href="#" class="tile tile-img mr-1">
                                                        <img class="img-fluid" src="{{ asset('admin/images/dummy/img-1.jpg') }}" alt="{{ $tag->name }}">
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#tagEdit" onclick="editTag({{ $tag->id }})">{{ $tag->name }}</a>
                                                </td>
                                                <td class="align-middle"> {{ $tag->slug }} </td>
                                                <td class="align-middle"> {{ $tag->created_by ? $tag->createdBy->name : '-' }} </td>
                                                <td class="align-middle"> {{ $tag->updated_by ? $tag->updatedBy->name : '-' }} </td>
                                                <td class="align-middle"> {{ $tag->created_at->diffForHumans() }} </td>
                                                <td class="align-middle"> {{ $tag->updated_at->diffForHumans() }} </td>
                                                <td class="d-flex justify-content-end align-middle" style="gap: 10px;">
                                                    <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="modal" data-target="#tagEdit" onclick="editTag({{ $tag->id }})">
                                                        <i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span>
                                                    </button>
                                                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-icon btn-secondary" id="delete">
                                                            <i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- /tr -->
                                        @endforeach
                                    </tbody>
                                    <!-- /tbody -->
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.table-responsive -->
                            <!-- .pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {!! $tags->links() !!}
                            </div>
                            <!-- /.pagination -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.page-section -->
            </div>
            <!-- /.page-inner -->
        @else
            <div id="notfound-state" class="empty-state" style="height: 85vh;">
                <!-- .empty-state-container -->
                <div class="empty-state-container">
                    <div class="state-figure">
                        <img class="img-fluid" src="{{ asset('admin/images/illustration/img-6.svg') }}" alt="empty-state" style="max-width: 300px">
                    </div>
                    <h3 class="state-header">No Content, Yet.</h3>
                    <p class="state-description lead text-muted">
                        Use the button below to add your first content.
                    </p>
                    <div class="state-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tagAdd">Create New</button>
                    </div>
                </div>
                <!-- /.empty-state-container -->
            </div>
        @endif

        <!-- Tag Add Modal -->
        <div class="modal fade has-shown" id="tagAdd" tabindex="-1" role="dialog" aria-labelledby="tagAddLabel" aria-modal="true">
            <!-- .modal-dialog -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <!-- .modal-content -->
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.tags.store') }}">
                        @csrf
                        <!-- .modal-header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Tag</h5>
                        </div>
                        <!-- /.modal-header -->
                        <!-- .modal-body -->
                        <div class="modal-body">
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="name">Tag name <span class="badge badge-danger">Required</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tag name" required />
                            </div>
                            <!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label class="d-flex justify-content-between" for="slug">
                                    <span>Slug <span class="badge badge-danger">Required</span></span>
                                    <a href="#slug" data-toggle="edit-input" aria-edit="false"><i class="fa fa-pencil-alt"></i> <span>Edit</span></a>
                                </label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Tag slug" required readonly />
                            </div>
                            <!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="description">Description <span class="badge badge-secondary"><em>Optional</em></span></label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Tag description (Optional)"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.modal-body -->
                        <!-- .modal-footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                        <!-- /.modal-footer -->
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- End Tag Add Modal -->

        <!-- Tag Edit Modal -->
        <div class="modal fade has-shown" id="tagEdit" tabindex="-1" role="dialog" aria-labelledby="tagEditLabel" aria-modal="true">
            <!-- .modal-dialog -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <!-- .modal-content -->
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.tags.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId" />
                        <!-- .modal-header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Tag</h5>
                        </div>
                        <!-- /.modal-header -->
                        <!-- .modal-body -->
                        <div class="modal-body">
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="editName">Tag name <span class="badge badge-danger">Required</span></label>
                                <input type="text" class="form-control" id="editName" name="name" placeholder="Tag name" required />
                            </div>
                            <!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label class="d-flex justify-content-between" for="editSlug">
                                    <span>Slug <span class="badge badge-danger">Required</span></span>
                                    <a href="#editSlug" data-toggle="edit-input" aria-edit="false">
                                        <i class="fa fa-pencil-alt"></i> <span>Edit</span>
                                    </a>
                                </label>
                                <input type="text" class="form-control" id="editSlug" name="slug" placeholder="Tag slug" required readonly />
                            </div>
                            <!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="editDescription">Description <span class="badge badge-secondary"><em>Optional</em></span></label>
                                <textarea class="form-control" id="editDescription" name="description" rows="3" placeholder="Tag description (Optional)"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.modal-body -->
                        <!-- .modal-footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                        <!-- /.modal-footer -->
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- End Tag Edit Modal -->
    </div>
    <!-- /.page -->
@endsection
@push('scripts')
    <script src="{{ asset('admin/javascript/pages/table-demo.js') }}"></script>
    <script>
        $('#name').keyup(function () {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        const editToggle = document.querySelectorAll('[data-toggle="edit-input"]');
        editToggle.forEach((el) => {
            el.addEventListener('click', function (event) {
                event.preventDefault();
                let iconToggle = el.querySelector('i');
                let inputToggle = document.querySelector(`${el.getAttribute('href')}`);
                if (el.hasAttribute('aria-edit') && el.getAttribute('aria-edit') === 'false') {
                    iconToggle.className = 'fas fa-check';
                    el.querySelector('span').innerText = 'Save';
                    inputToggle.readOnly = false;
                    el.setAttribute('aria-edit', 'true');
                }  else {
                    iconToggle.className = 'fa fa-pencil-alt';
                    el.querySelector('span').innerText = 'Edit';
                    inputToggle.readOnly = true;
                    el.setAttribute('aria-edit', 'false');
                }
            });
        });

        async function editTag(id) {
            try {
                const response = await fetch(`/admin/tags/${id}/edit`);
                const category = await response.json();
                if (category && response.status === 200) {
                    document.getElementById('editId').value = category.id;
                    document.getElementById('editName').value = category.name;
                    document.getElementById('editSlug').value = category.slug;
                    document.getElementById('editDescription').value = category.description;
                }
            } catch (e) {
                console.log(e.message);
            }
        }

        function removeQueryString() {
            location.replace('/admin/tags');
        }
    </script>
@endpush
