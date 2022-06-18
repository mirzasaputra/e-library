@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-fill border-bottom" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.borrows') }}" data-toggle="ajax">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.bookings') }}" data-toggle="ajax">Pengambilan</a>
            </li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body py-3">
        <div class="row mb-3">
            <div class="col-6 d-flex align-items-center justify-content-center mx-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari transaksi booking..">
                    <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="ml-1">
                    <button class="btn btn-dark" style="white-space: nowrap;" data-toggle="ajax" data-target="{{ route('admin.bookings.scan-qr-code') }}">Scan QRCode</button>
                </div>
            </div>
        </div>
        @if($bookings->count() > 0)
            <table class="table table-striped" width="100%">
                <thead>
                    <th width="1%">No.</th>
                    <th>Kode Transaction</th>
                    <th>Nama Anggota</th>
                    <th>Jumlah Buku</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($bookings as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->transaction_code }}</td>
                        <td>{{ $item->member->name }}</td>
                        <td>{{ $item->transactionDetail->count() }}</td>
                        <td>
                            <a href="{{ route('admin.bookings.show', $item->hashid) }}" class="btn btn-primary btn-sm" data-toggle="ajax">
                                <i class="fa fa-eye"></i>
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="col-4 mx-auto mb-3">
                <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="100%">
                <h5 class="text-primary text-center" style="margin-top: -20px;">No Result Found.</h5>
           </div>
        @endif
    </div>
</div>

@endsection