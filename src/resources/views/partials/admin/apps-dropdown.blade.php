<div class="nav-item dropdown d-none d-md-flex me-3">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show app menu"
    data-bs-auto-close="outside" aria-expanded="false">
        <x-icon name="apps" class="icon-1" />
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
                                    <x-icon name="{{ $app['icon'] }}" class="text-primary" size="16" />
                                </div>
                                <span class="h6">{{ $app['name'] }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>