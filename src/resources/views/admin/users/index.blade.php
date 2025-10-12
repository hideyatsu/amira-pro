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
                        ['label' => 'Name', 'width' => 25],
                        ['label' => 'Email', 'width' => 25],
                        ['label' => 'Role', 'width' => 15],
                        ['label' => 'Actions', 'width' => 10, 'no-export' => true],
                    ];

                    $config = [
                        'ajax' => route('admin.users.index'),
                        'columns' => [
                            ['data' => 'name', 'name' => 'name'],
                            ['data' => 'email', 'name' => 'email'],
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
