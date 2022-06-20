@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Pengembalian</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body py-3">
        <div class="row mb-3">
            <div class="col-6 d-flex align-items-center justify-content-center mx-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari data transaksi..">
                    <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="ml-1">
                    <button class="btn btn-dark" style="white-space: nowrap;" data-toggle="ajax" data-target="{{ route('admin.book-returns.scan-qr-code') }}">Scan QRCode</button>
                </div>
            </div>
        </div>
        @if($data->count() > 0)
            <table class="table table-striped" width="100%">
                <thead>
                    <th>No.</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tenggat Waktu</th>
                    <th>Jumlah Buku</th>
                    <th>Jumlah Denda</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['transaction_code'] }}</td>
                            <td>{{ date('d M Y', strtotime($item['date'])) }}</td>
                            <td>
                                {{ date('d M Y', strtotime($item['date_of_return'])) }}
                                @if($item['late'] > 0)
                                    <p class="m-0 p-0">
                                        <i class="text-danger small">Telat {{$item['late']}} hari.</i>
                                    </p>
                                @endif
                            </td>
                            <td>{{ $item['transactionDetail']->count() }}</td>
                            <td>Rp. {{ number_format($item['late'] * getSetting('app_money_fine'), 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.book-returns.show', $item['hashid']) }}" data-toggle="ajax" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Detail</a>
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