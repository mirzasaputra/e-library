@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Members</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="col-12 text-right mb-1">
            <button class="btn btn-primary" data-toggle="ajax" data-target="{{ route('admin.members.create') }}"><i class="fa fa-plus"></i> Tambah</button>
        </div>
        <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.members.getData') }}" width="100%">
            <thead>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Alamat</th>
                <th></th>
            </thead>
        </table>
    </div>
</div>

@endsection