<!-- BEGIN PAGE HEADER -->
<div class="page-header d-print-none" aria-label="Page header">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                @hasSection('page-pretitle')
                    <div class="page-pretitle">@yield('page-pretitle')</div>
                @endif
                <h2 class="page-title">@yield('page-title', 'Dashboard')</h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @yield('page-actions')
                </div>
            </div>
        </div>

        <!-- Breadcrumb (optional) -->
        @hasSection('breadcrumb')
            <div class="row mt-2">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>
        @endif

        <!-- Page description (optional) -->
        @hasSection('page-description')
            <div class="row mt-2">
                <div class="col-12">
                    <div class="text-secondary">
                        @yield('page-description')
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- END PAGE HEADER -->
