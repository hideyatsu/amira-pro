<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.4.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.admin.head')
    @stack('page-styles')
</head>
<body>
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('dist/js/tabler-theme.min.js') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->

    <div class="page">
        @include('partials.admin.header')
        @include('partials.admin.navigation')

        <!-- BEGIN PAGE WRAPPER -->
        <div class="page-wrapper">
            @hasSection('page-header')
                @include('partials.admin.page-header')
            @endif

            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            <!-- END PAGE BODY -->

            @include('partials.admin.footer')
        </div>
        <!-- END PAGE WRAPPER -->
    </div>

    @include('partials.admin.scripts')
    @stack('page-scripts')
</body>
</html>
