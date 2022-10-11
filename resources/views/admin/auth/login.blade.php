@extends('admin.layouts.guest')

@section('title', 'Sign In')

@section('content')
    <header id="auth-header" class="auth-header" style="background-image: url({{ asset('admin/images/illustration/img-1.png') }});">
        <h1>ADMIN LOGIN <span class="sr-only">Sign In</span></h1>
    </header>
    <!-- form -->
    <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" required autofocus="">
                <label for="email">Email Address</label>
            </div>
        </div>
        <!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                <label for="password">Password</label>
            </div>
        </div>
        <!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
        </div>
        <!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group text-center">
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember-me" name="remember">
                <label class="custom-control-label" for="remember-me">Keep me sign in</label>
            </div>
        </div>
        <!-- /.form-group -->
        <!-- recovery links -->
        <div class="text-center pt-3">
            <a href="{{ route('password.request') }}" class="link">Forgot Password?</a>
        </div>
        <!-- /recovery links -->
    </form>
    <!-- /.auth-form -->
@endsection
