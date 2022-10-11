<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- SEO Tags -->
            {!! SEO::generate() !!}
        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('admin/apple-touch-icon.png') }}">
        <link rel="shortcut icon" href="{{ asset('admin/favicon.ico') }}">
        <meta name="theme-color" content="#3063A0">
        <!-- GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
        <!-- End GOOGLE FONT -->
        <!-- Base CSS -->
        <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
        <!-- Custom css -->
        <link rel="stylesheet" href="{{ asset('web/css/style.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/css/media.css') }}" />
        <!-- BEGIN PAGE CSS -->
        @stack('styles')
        <!-- END PAGE CSS -->
{{--        <script src="https://js.hcaptcha.com/1/api.js?onload=onloadCallbackRecaptcha&render=explicit" async defer></script>--}}
{{--        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackRecaptcha&render=explicit" async defer>--}}
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-0SG2GG06W4"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-0SG2GG06W4');
        </script>
        <!-- End Google tag (gtag.js) -->
        <style>
            .top-bar-section {
                border-bottom: 1px solid #e8eaed;
                padding: 10px 0;
            }
        </style>
    </head>

    <body>
        @php
            $header = customize('header');
            $getTopCategories = getTopCategories(5);
            $getTopTags = getTopTags(10);
        @endphp
        <main>
{{--            @include('web.layouts.continue-popup')--}}
{{--            @include('web.layouts.hCaptcha')--}}
            <!-- Start Main Header Section -->
            @include('web.layouts.header-desktop')
            @include('web.layouts.header-mobile')
            <!-- End Main Header Section -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- footer section start -->
            @include('web.layouts.footer')
            <!-- footer section end -->
        </main>
        <!-- Global Assets link -->
        <script src="{{ asset('web/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Custom js link  -->
{{--        <script src="{{ asset('web/js/script.js') }}"></script>--}}
        <!-- BEGIN PAGE js -->
        @stack('scripts')
        <!-- END PAGE js -->
    </body>
</html>
