<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Dashboard') - {{ config('app.name', 'Admin Panel') }}</title>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="{{ asset('dist/css/tabler.css') }}" rel="stylesheet" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PLUGINS STYLES -->
<link href="{{ asset('dist/css/tabler-flags.css') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-socials.css') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-payments.css') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-vendors.css') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-marketing.css') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-themes.css') }}" rel="stylesheet" />
<!-- END PLUGINS STYLES -->

<!-- BEGIN CUSTOM FONT -->
<style>
    @import url("https://rsms.me/inter/inter.css");
</style>
<!-- END CUSTOM FONT -->
