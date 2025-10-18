@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">All Users</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm">
                            <x-icon name="plus" class="me-2" />
                            Add User
                        </a>
                    </div>
                </x-slot>

                @php
                    $heads = [
                        ['label' => 'Name'],
                        ['label' => 'Email', 'width' => 25],
                        ['label' => 'Status', 'width' => 10],
                        ['label' => 'Role', 'width' => 15],
                        ['label' => 'Actions', 'width' => 20, 'no-export' => true],
                    ];

                    $config = [
                        'ajax' => route('admin.users.index'),
                        'columns' => [
                            ['data' => 'name', 'name' => 'name'],
                            ['data' => 'email', 'name' => 'email'],
                            ['data' => 'status', 'name' => 'status', 'orderable' => false, 'searchable' => false],
                            ['data' => 'roles', 'name' => 'roles'],
                            [
                                'data' => 'actions',
                                'name' => 'actions',
                                'orderable' => false,
                                'searchable' => false
                            ],
                        ],
                        'order' => [[0, 'asc']], // Order by 'Joined Date' descending
                    ];
                @endphp

                <x-datatable
                    :heads="$heads"
                    :config="$config"
                    :server-side="true"
                />
            </x-card>
        </div>
    </div>
@endsection

<script>
// Define deleteUser function globally to be accessible from AJAX loaded content
window.deleteUser = function(userId, userName, deleteUrl) {
    if (confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`)) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteUrl;

        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        // Add DELETE method
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        // Submit the form
        document.body.appendChild(form);
        form.submit();
    }
};
</script>
