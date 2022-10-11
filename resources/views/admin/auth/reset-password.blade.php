@extends('admin.layouts.guest')

@section('title', 'Reset Password')

@section('content')
    <header id="auth-header" class="auth-header" style="background-image: url({{ asset('admin/images/illustration/img-1.png') }});">
        <h1>ADMIN RESET PASSWORD <span class="sr-only">Reset Password</span></h1>
    </header>
    <!-- form -->
    <form class="auth-form" method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" placeholder="Email Address" required />
                <label for="email">Email Address</label>
            </div>
        </div>
        <!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                <label for="password">Password</label>
            </div>
        </div>
        <!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Password" required />
                <label for="password_confirmation">Confirm Password</label>
            </div>
        </div>
        <!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        </div>
        <!-- /.form-group -->
    </form>
    <!-- /.auth-form -->
@endsection
