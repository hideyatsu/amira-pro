
<div class="nav-item dropdown d-none d-md-flex">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications"
        data-bs-auto-close="outside" aria-expanded="false">
        <x-icon name="bell" class="icon-1" />
        @if(isset($unreadNotifications) && $unreadNotifications > 0)
            <span class="badge bg-red">{{ $unreadNotifications }}</span>
        @else
            <span class="badge bg-red"></span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="card-title">Notifications</h3>
                <div class="btn-close ms-auto" data-bs-dismiss="dropdown"></div>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @forelse($notifications ?? [] as $notification)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="status-dot {{ $notification->read_at ? 'd-block' : 'status-dot-animated bg-red d-block' }}"></span>
                            </div>
                            <div class="col text-truncate">
                                <a href="#" class="text-body d-block">{{ $notification->title }}</a>
                                <div class="d-block text-secondary text-truncate mt-n1">{{ $notification->message }}</div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="list-group-item-actions">
                                    <x-icon name="star" class="text-muted icon-2" />
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">
                        <div class="text-center text-muted">No notifications</div>
                    </div>
                @endforelse
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="#" class="btn btn-2 w-100">Archive all</a>
                    </div>
                    <div class="col">
                        <a href="#" class="btn btn-2 w-100">Mark all as read</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>