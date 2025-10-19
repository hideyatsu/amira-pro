<!-- BEGIN NAVBAR  -->
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <!-- BEGIN NAVBAR TOGGLER -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
            aria-controls="navbar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- END NAVBAR TOGGLER -->

        <!-- BEGIN NAVBAR LOGO -->
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('admin.dashboard') }}" aria-label="{{ config('app.name') }}">
                <x-logo />
            </a>
        </div>
        <!-- END NAVBAR LOGO -->

        <div class="navbar-nav flex-row order-md-last">
            <!-- Action buttons (optional) -->
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    @yield('header-buttons')
                </div>
            </div>

            <div class="d-none d-md-flex">
                <!-- Theme toggle -->
                @include('partials.admin.theme-toggle')

                <!-- Notifications -->
                @include('partials.admin.notifications')

                <!-- Apps dropdown -->
                @include('partials.admin.apps-dropdown')
            </div>

            <!-- User dropdown -->
            <div class="nav-item dropdown">
                @include('partials.admin.user-dropdown')
            </div>
        </div>
    </div>
</header>
<!-- END NAVBAR -->
