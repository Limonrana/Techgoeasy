<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ config('app.name', 'JustEarn Blog') }}</title>

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('admin/apple-touch-icon.png') }}">
        <link rel="shortcut icon" href="{{ asset('admin/favicon.ico') }}">
        <meta name="theme-color" content="#3063A0"><!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
        <!-- BEGIN PLUGINS STYLES -->
        <link rel="stylesheet" href="{{ asset('admin/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}"><!-- END PLUGINS STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link rel="stylesheet" href="{{ asset('admin/stylesheets/theme.min.css') }}" data-skin="default">
        <link rel="stylesheet" href="{{ asset('admin/stylesheets/theme-dark.min.css') }}" data-skin="dark">
        <link rel="stylesheet" href="{{ asset('admin/stylesheets/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script>
            var skin = localStorage.getItem('skin') || 'default';
            var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
            // Disable unused skin immediately
            disabledSkinStylesheet.setAttribute('rel', '');
            disabledSkinStylesheet.setAttribute('disabled', true);
            // add loading class to html immediately
            document.querySelector('html').classList.add('loading');
        </script>
        <!-- END THEME STYLES -->
    </head>
    <body>
        <main class="auth">
            <!-- Content -->
                @yield('content')
            <!-- End Content -->
            <!-- copyright -->
            <footer class="auth-footer">
                © {{ \Illuminate\Support\Facades\Date::now()->format('Y') }} All Rights Reserved. <a href="#">Privacy</a> and <a href="#">Terms</a>
            </footer>
        </main>
        <!-- BEGIN BASE JS -->
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- END BASE JS -->
        <!-- BEGIN PLUGINS JS -->
        <script src="{{ asset('admin/vendor/particles.js/particles.js') }}"></script>
        <script>
            /**
             * Keep in mind that your scripts may not always be executed after the theme is completely ready,
             * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
             */
            $(document).on('theme:init', () => {
                /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
                particlesJS.load('auth-header', 'assets/javascript/pages/particles.json');
            });
        </script> <!-- END PLUGINS JS -->
        <!-- BEGIN THEME JS -->
        <script src="{{ asset('admin/javascript/theme.js') }}"></script>
        <!-- END THEME JS -->

        {{--Extra JS Plugin--}}
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            @if(Session::has('success'))
                toastr.options = {"closeButton" : true, "progressBar" : true};
                toastr.success("{{ session('success') }}");
            @elseif(Session::has('status'))
                toastr.options = {"closeButton" : true, "progressBar" : true};
                toastr.success("{{ session('status') }}");
            @elseif(Session::has('warning'))
                toastr.options = {"closeButton" : true, "progressBar" : true};
                toastr.warning("{{ session('warning') }}");
            @elseif(Session::has('error'))
                toastr.options = {"closeButton" : true, "progressBar" : true};
                toastr.error("{{ session('error') }}");
            @endif
        </script>
    </body>
</html>
