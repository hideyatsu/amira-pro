@extends('layouts.admin')

@section('title', 'Roles Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">All Roles</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-sm">
                            <x-icon name="plus" class="me-2" />
                            Add Role
                        </a>
                    </div>
                </x-slot>

                @php
                    $heads = [
                        ['label' => 'Name'],
                        ['label' => 'Permissions', 'width' => 30],
                        ['label' => 'Users', 'width' => 10],
                        ['label' => 'Actions', 'width' => 20, 'no-export' => true],
                    ];

                    $config = [
                        'ajax' => route('admin.roles.index'),
                        'columns' => [
                            ['data' => 'name', 'name' => 'name'],
                            ['data' => 'permissions', 'name' => 'permissions'],
                            ['data' => 'users_count', 'name' => 'users_count'],
                            [
                                'data' => 'actions',
                                'name' => 'actions',
                                'orderable' => false,
                                'searchable' => false
                            ],
                        ],
                        'order' => [[0, 'asc']],
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
// Define deleteRole function globally to be accessible from AJAX loaded content
window.deleteRole = function(roleId, roleName, deleteUrl) {
    if (confirm(`Are you sure you want to delete role "${roleName}"? This action cannot be undone.`)) {
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
