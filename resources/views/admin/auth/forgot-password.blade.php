@extends('admin.layouts.guest')

@section('title', 'Reset Password')

@section('content')
    <!-- form -->
    <form class="auth-form auth-form-reflow" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="text-center mb-4">
            <div class="mb-4">
                <img class="rounded" src="{{ asset('admin/apple-touch-icon.png') }}" alt="" height="72">
            </div>
            <h1 class="h3"> Reset Your Password </h1>
        </div>
        <p class="mb-4">Forgot your password? No problem. Just let us know your email address</p>
        <!-- .form-group -->
        <div class="form-group mb-4">
            <label class="d-block text-left" for="email">Email Address</label>
            <input type="email" id="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autofocus />
            <p class="text-muted">
                <small>We'll send password reset link to your email.</small>
            </p>
        </div>
        <!-- /.form-group -->
        <!-- actions -->
        <div class="d-block d-md-inline-block mb-2">
            <button class="btn btn-lg btn-block btn-primary" type="submit">Reset Password</button>
        </div>
        <div class="d-block d-md-inline-block">
            <a href="{{ route('login') }}" class="btn btn-block btn-light">Return to signin</a>
        </div>
    </form>
    <!-- end form -->
@endsection
