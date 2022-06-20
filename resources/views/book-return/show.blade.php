@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.book-returns') }}" data-toggle="ajax">Pengembalian</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="font-weight-700">Information</h4>
        <hr>
        <div class="row">
            <div class="col-6">
                <table cellpadding="8">
                    <tr>
                        <th>Kode Transaksi</th>
                        <td>: {{ $transaction->transaction_code }}</td>
                    </tr>
                    <tr>
                        <th>Nama Anggota</th>
                        <td>: {{ $transaction->member->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Peminjaman</th>
                        <td>: {{ date('d M Y', strtotime($transaction->date)) }} - {{ date('d M Y', strtotime($transaction->date_of_return)) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table cellpadding="8">
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($transaction->status == 'not_be_restored')
                                <i class="badge badge-warning">Belum Dikembalikan</i>
                            @else
                                <i class="badge badge-primary">Sudah Dikembalikan</i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Denda</th>
                        <td>: Rp. {{ number_format($late * getSetting('app_money_fine'), 0, ',', '.') }} @if($late > 0)- <i class="text-danger small">Telat {{$late}} hari.</i>@endif</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.book-returns.getDataDetail', $transaction->hashid) }}" width="100%">
            <thead>
                <th>No.</th>
                <th>Nama Buku</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th></th>
            </thead>
        </table>
    </div>
</div>

@endsection