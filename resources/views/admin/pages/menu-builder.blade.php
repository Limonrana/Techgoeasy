@extends('admin.layouts.app')

@section('title', 'Menu Builder')

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
                </nav><!-- /.breadcrumb -->
                <!-- floating action -->
                <button type="button" class="btn btn-success btn-floated" data-toggle="modal" data-target="#menuAdd">
                    <span class="fa fa-plus"></span>
                </button>
                <!-- /floating action -->
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                    <h1 class="page-title mr-sm-auto"> Menu Builder </h1>
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
            <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid">
                    <!-- .card-body -->
                    <div class="card-body">
                        <!-- .table-responsive -->
                        <div class="table-responsive">
                            <!-- .table -->
                            <table class="table">
                                <!-- thead -->
                                <thead>
                                <tr>
                                    <th colspan="2" style="min-width:120px">Name</th>
                                    <th> Type </th>
                                    <th> Last Updated </th>
                                    <th style="width:100px; min-width:100px;"> &nbsp; </th>
                                </tr>
                                </thead>
                                <!-- /thead -->
                                <!-- tbody -->
                                <tbody>
                                    @foreach($menus as $menu)
                                        <!-- tr -->
                                        <tr>
                                            <td>
                                                <p><span class="drag-indicator"></span> {{ $menu->name }}</p>
                                            </td>
                                            <td class="align-middle"> {{ $menu->type ?? '-' }} </td>
                                            <td class="align-middle"> {{ $menu->update_at ? $menu->update_at->diffForHumans() : $menu->update_at->diffForHumans() }} </td>
                                            <td class="d-flex justify-content-end align-middle" style="gap: 10px;">
                                                <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="modal" data-target="#categoryEdit">
                                                    <i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span>
                                                </button>
                                                <form action="#" method="POST">
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
{{--                            {!! $categories->links() !!}--}}
                        </div>
                        <!-- /.pagination -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.page-inner -->

        <!-- Menu Add Modal -->
        <div class="modal fade has-shown" id="menuAdd" tabindex="-1" role="dialog" aria-labelledby="menuAddLabel" aria-modal="true">
            <!-- .modal-dialog -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <!-- .modal-content -->
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <!-- .modal-header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Menu</h5>
                        </div>
                        <!-- /.modal-header -->
                        <!-- .modal-body -->
                        <div class="modal-body">
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="name">Menu name <span class="badge badge-danger">Required</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Menu name" required />
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
        <!-- End Menu Add Modal -->
    </div>
    <!-- /.page -->
@endsection

@push('scripts')

@endpush
