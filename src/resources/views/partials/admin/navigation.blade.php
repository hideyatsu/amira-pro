<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">
                        <!-- BEGIN NAVBAR MENU -->
                        <ul class="navbar-nav">
                            @foreach($menuItems as $item)
                                @include('partials.admin.menu-item', ['item' => $item])
                            @endforeach
                        </ul>
                        <!-- END NAVBAR MENU -->
                    </div>

                    <!-- Search bar (optional) -->
                    <div class="col-md-auto px-0">
                        @yield('navbar-search')
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
