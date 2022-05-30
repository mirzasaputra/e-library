@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="col-12 text-right mb-1">
            <button class="btn btn-primary" data-toggle="ajax" data-target="{{ route('admin.books.create') }}"><i class="fa fa-plus"></i> Tambah</button>
        </div>
        <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.books.getData') }}" width="100%">
            <thead>
                <th>No.</th>
                <th>Images</th>
                <th>Nama</th>
                <th>Deskrisi</th>
                <th>Tahun Terbit</th>
                <th>Penulis</th>
                <th></th>
            </thead>
        </table>
    </div>
</div>

@endsection