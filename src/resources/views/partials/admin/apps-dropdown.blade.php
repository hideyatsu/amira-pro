<a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show app menu"
   data-bs-auto-close="outside" aria-expanded="false">
    <!-- Download SVG icon from http://tabler.io/icons/icon/apps -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-1">
        <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
        <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
        <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
        <path d="M14 7l6 0" />
        <path d="M17 4l0 6" />
    </svg>
</a>
<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Quick Apps</div>
        </div>
        <div class="card-body scroll-y p-2" style="max-height: 50vh">
            <div class="row g-0">
                @foreach($quickApps ?? [
                    ['name' => 'Dashboard', 'icon' => 'home', 'url' => 'admin.dashboard'],
                    ['name' => 'Users', 'icon' => 'users', 'url' => 'admin.users'],
                    ['name' => 'Settings', 'icon' => 'settings', 'url' => 'admin.settings'],
                    ['name' => 'Reports', 'icon' => 'chart-bar', 'url' => 'admin.reports']
                ] as $app)
                    <div class="col-4">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex flex-column flex-center text-center text-secondary py-2 px-2 link-hoverable">
                            <div class="w-6 h-6 mx-auto mb-2 d-flex align-items-center justify-content-center bg-primary-lt rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon text-primary">
                                    @switch($app['icon'])
                                        @case('home')
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                            @break
                                        @case('users')
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                            @break
                                        @case('settings')
                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            @break
                                        @case('chart-bar')
                                            <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M4 20l14 0" />
                                            @break
                                    @endswitch
                                </svg>
                            </div>
                            <span class="h6">{{ $app['name'] }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
