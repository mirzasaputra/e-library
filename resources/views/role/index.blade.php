@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Roles</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="col-12 text-right mb-1">
            <button class="btn btn-primary" data-toggle="ajax" data-target="{{ route('admin.users.create') }}"><i class="fa fa-plus"></i> Tambah</button>
        </div>
        <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.roles.getData') }}" width="100%">
            <thead>
                <th>No.</th>
                <th>Nama</th>
                <th></th>
            </thead>
        </table>
    </div>
</div>

@endsection