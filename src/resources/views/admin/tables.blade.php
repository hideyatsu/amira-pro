@extends('layouts.admin')

@section('title', 'Tables')

@section('page-title', 'Tables')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tables</li>
@endsection

@section('content')
<div class="row row-cards">
    <!-- Basic Table -->
    <div class="col-12">
        <x-card title="Basic Table">
            <x-table
                :headers="['Name', 'Position', 'Email', 'Role', 'Actions']"
                :table-data="[
                    ['Paweł Kuna', 'UI Designer', 'paweluna@howstuffworks.com', 'User', '<a href=\'#\' class=\'btn btn-sm btn-primary\'>Edit</a>'],
                    ['Jeffie Lewzey', 'Chemical Engineer', 'jlewzey1@seesaa.net', 'User', '<a href=\'#\' class=\'btn btn-sm btn-primary\'>Edit</a>'],
                    ['Mallory Hulme', 'Geologist IV', 'mhulme2@domainmarket.com', 'User', '<a href=\'#\' class=\'btn btn-sm btn-primary\'>Edit</a>'],
                    ['Dunn Slane', 'Research Nurse', 'dslane3@epa.gov', 'Owner', '<a href=\'#\' class=\'btn btn-sm btn-primary\'>Edit</a>']
                ]"
                :striped="true"
                :hover="true"
            />
        </x-card>
    </div>
    <!-- End Basic Table -->
    <!-- DataTable -->
    <div class="col-12">
        <x-card title="DataTable Example">
            @php
                $heads = [
                    'ID',
                    'Nama Pengguna',
                    'Email',
                    ['label' => 'Aksi', 'width' => 25]
                ];

                $config = [
                    // --- PENTING: Konfigurasi AJAX ---
                    'ajax' => route('admin.users.index'), // Route yang baru kita buat

                    'columns' => [
                        // 'data' harus sesuai dengan kolom yang dipilih di controller (User::select)
                        ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                        ['data' => 'name', 'name' => 'name', 'title' => 'Nama Pengguna'],
                        ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                        // Kolom 'actions' adalah kolom kustom yang kita buat di controller
                        ['data' => 'actions', 'name' => 'actions', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false],
                    ],

                    'order' => [[0, 'desc']], // Urutkan berdasarkan ID secara descending
                ];
            @endphp
            <x-datatable
                :heads="$heads"
                :server-side="true"
                :config="$config"
                striped
                hoverable
            />
        </x-card>
    </div>
    <!-- End DataTable -->
</div>
@endsection
