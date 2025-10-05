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
</div>
@endsection
