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
        <!-- GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
        <!-- BEGIN PLUGINS STYLES -->
        <link rel="stylesheet" href="{{ asset('admin/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendor/flatpickr/flatpickr.min.css') }}">
        <!-- END PLUGINS STYLES -->
        @stack('head-styles')
        <!-- BEGIN THEME STYLES -->
        <link rel="stylesheet" href="{{ asset('admin/stylesheets/theme.min.css') }}" data-skin="default">
        <link rel="stylesheet" href="{{ asset('admin/stylesheets/theme-dark.min.css') }}" data-skin="dark">
        <link rel="stylesheet" href="{{ asset('admin/stylesheets/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- BEGIN PAGE CSS -->
        <style>
            .swal2-actions {
                gap: 35px !important;
            }
        </style>
        @stack('styles')
        <!-- END PAGE CSS -->
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
        <div class="app">
            @include('admin.layouts.topbar')
            @include('admin.layouts.sidebar')
            <main class="app-main">
                <!-- .wrapper -->
                <div class="wrapper">
                    <!-- .page -->
                    @yield('content')
                    <!-- End Page -->
                </div>
            </main>
            @include('admin.layouts.footer')
        </div>
        <!-- BEGIN BASE JS -->
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- END BASE JS -->

        <!-- BEGIN PLUGINS JS -->
        <script src="{{ asset('admin/vendor/pace-progress/pace.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        @stack('plugin_scripts')
        <!-- END PLUGINS JS -->

        <!-- BEGIN THEME JS -->
        <script src="{{ asset('admin/javascript/theme.min.js') }}"></script>
        <!-- END THEME JS -->

        <!-- BEGIN PAGE JS -->
        @stack('scripts')
        <!-- END PAGE JS -->

        {{--Extra JS Plugin--}}
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if(Session::has('success'))
                toastr.options = {"progressBar" : true};
                toastr.success("{{ session('success') }}");
            @elseif(Session::has('status'))
                toastr.options = {"progressBar" : true};
                toastr.success("{{ session('status') }}");
            @elseif(Session::has('warning'))
                toastr.options = {"progressBar" : true};
                toastr.warning("{{ session('warning') }}");
            @elseif(Session::has('error'))
                toastr.options = {"progressBar" : true};
                toastr.error("{{ session('error') }}");
            @endif

            $(document).on("click", "#delete", function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                var parent = $(this).parent();
                var child = $(this).children();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        if (link !== undefined && link !== 'javascript:;') {
                            window.location.href = link;
                        } else if (parent !== undefined && parent[0].nodeName === 'FORM') {
                            parent.submit();
                        } else {
                            child.submit();
                        }
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your targeted file is safe :)',
                            'error'
                        )
                    }
                })
            });
        </script>
    </body>
</html>
