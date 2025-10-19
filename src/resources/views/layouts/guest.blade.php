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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Authentication') - {{ config('app.name', 'Laravel') }}</title>

    <meta name="msapplication-TileColor" content="#066fd1" />
    <meta name="theme-color" content="#066fd1" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PLUGINS STYLES -->
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-socials.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-marketing.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-themes.min.css') }}" rel="stylesheet" />
    <!-- END PLUGINS STYLES -->

    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->

    @stack('styles')
</head>
<body>
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('dist/js/tabler-theme.min.js') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <!-- BEGIN NAVBAR LOGO -->
                <a href="{{ url('/') }}" aria-label="{{ config('app.name') }}" class="navbar-brand navbar-brand-autodark">
                    <x-logo />
                </a>
                <!-- END NAVBAR LOGO -->
            </div>

            {{ $slot }}
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    @stack('scripts')
</body>
</html>
