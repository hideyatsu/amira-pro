<a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
    <span class="avatar avatar-sm" style="background-image: url({{ auth()->user()->avatar_url }})"></span>
    <div class="d-none d-xl-block ps-2">
        <div>{{ auth()->user()->name ?? 'Admin User' }}</div>
        <div class="mt-1 small text-secondary">{{ auth()->user()->roles->first()?->name ?? 'User' }}</div>
    </div>
</a>
<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
    <a href="{{ route('profile.edit') }}" class="dropdown-item">
        <x-icon name="user" class="me-2" size="18" />
        Profile
    </a>
    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
        <x-icon name="settings" class="me-2" size="18" />
        Settings
    </a>
    <div class="dropdown-divider"></div>
    <a href="{{ route('logout') }}" class="dropdown-item"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <x-icon name="logout" class="me-2" size="18" />
        Logout
    </a>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
