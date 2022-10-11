@extends('admin.layouts.guest')

@section('title', 'Confirm Password')

@section('content')
    <!-- form -->
    <form class="auth-form auth-form-reflow" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="text-center mb-4">
            <div class="mb-4">
                <img class="rounded" src="{{ asset('admin/apple-touch-icon.png') }}" alt="" height="72">
            </div>
            <h1 class="h3"> Confirm Your Password </h1>
        </div>
        <p class="mb-4">This is a secure area of the application. Please confirm your password before continuing.</p>
        <!-- .form-group -->
        <div class="form-group mb-4">
            <label class="d-block text-left" for="password">Password</label>
            <input type="password" id="password" class="form-control form-control-lg" name="password" value="{{ old('password') }}" required autocomplete="current-password" />
        </div>
        <!-- /.form-group -->
        <!-- actions -->
        <div class="d-block d-md-inline-block mb-2">
            <button class="btn btn-lg btn-block btn-primary" type="submit">Confirm Password</button>
        </div>
    </form>
    <!-- end form -->
@endsection
