@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.bookings') }}" data-toggle="ajax">Pengembalian</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('admin.bookings') }}" data-toggle="ajax" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('admin.bookings.confirm', $transaction->hashid) }}" id="confirm" data-success-callback="{{ route('admin.bookings') }}" class="btn btn-primary">Konfirmasi Pengambilan</a>
        </div>
        <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.bookings.getDataDetail', $transaction->hashid) }}" width="100%">
            <thead>
                <th>No.</th>
                <th>Nama Buku</th>
                <th>Deskripsi</th>
            </thead>
        </table>
    </div>
</div>

@endsection