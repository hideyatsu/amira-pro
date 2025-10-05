<a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
    <span class="avatar avatar-sm" style="background-image: url({{ auth()->user()->avatar ?? asset('static/avatars/000m.jpg') }})"></span>
    <div class="d-none d-xl-block ps-2">
        <div>{{ auth()->user()->name ?? 'Admin User' }}</div>
        <div class="mt-1 small text-secondary">{{ auth()->user()->role ?? 'Administrator' }}</div>
    </div>
</a>
<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
    <a href="#" class="dropdown-item">Status</a>
    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Profile</a>
    <a href="#" class="dropdown-item">Feedback</a>
    <div class="dropdown-divider"></div>
    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Settings</a>
    <a href="{{ route('admin.dashboard') }}" class="dropdown-item"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
</div>

<form id="logout-form" action="{{ route('admin.dashboard') }}" method="POST" class="d-none">
    @csrf
</form>
