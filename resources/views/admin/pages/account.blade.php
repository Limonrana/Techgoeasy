@extends('admin.layouts.app')

@section('title', 'My Account')

@section('content')
    <!-- .page -->
    <div class="page">
        <!-- .page-cover -->
        <header class="page-cover">
            <div class="text-center">
                <a href="user-profile.html" class="user-avatar user-avatar-xl">
                    <img src="{{ 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&color=7F9CF5&background=EBF4FF' }}" alt="{{ Auth::user()->name }}">
                </a>
                <h2 class="h4 mt-2 mb-0"> {{ Auth::user()->name }} </h2>
                <p class="text-muted">
                    @if (Auth::user()->is_super) Super Admin @else Admin @endif
                </p>
            </div>
        </header>
        <!-- /.page-cover -->
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
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
            <!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- grid row -->
                <div class="row">
                    <!-- grid column -->
                    <div class="col-lg-4">
                        <!-- .card -->
                        <div class="card card-fluid">
                            <h6 class="card-header"> Your Details </h6><!-- .nav -->
                            <nav class="nav nav-tabs flex-column border-0">
                                <a href="{{ route('admin.account') }}" class="nav-link active">Account</a>
                                <a href="{{ route('admin.change.password') }}" class="nav-link">Change Password</a>
                            </nav><!-- /.nav -->
                        </div><!-- /.card -->
                    </div><!-- /grid column -->
                    <!-- grid column -->
                    <div class="col-lg-8">
                        <!-- .card -->
                        <div class="card card-fluid">
                            <h6 class="card-header">My Account</h6>
                            <div class="card-body">
                                <!-- form -->
                                <form method="POST" action="{{ route('admin.account.update') }}">
                                    @csrf
                                    @method('put')
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}"  />
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}"  />
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                    <hr>
                                    <!-- .form-actions -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary text-nowrap ml-auto">Update Account</button>
                                    </div><!-- /.form-actions -->
                                </form><!-- /form -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /grid column -->
                </div><!-- /grid row -->
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div>
    <!-- /.page -->
@endsection
