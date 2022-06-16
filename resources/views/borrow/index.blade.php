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
                <a class="nav-link active" href="{{ route('admin.borrows') }}" data-toggle="ajax">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.bookings') }}" data-toggle="ajax">Booking <span class="badge badge-pill badge-primary">0</span></a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="text" class="form-control" value="{{ now() }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Anggota</label>
                    <select name="" id="member_id" class="form-control select2">
                        <option value="">Pilih Anggota</option>
                        @foreach($members as $item)
                            <option value="{{ $item->hashid }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <a href="" class="nav-link small">Tambah Anggota</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <label for="">Masukkan Kode Buku</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Masukkan Kode Buku">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary search-book"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-danger w-100" onclick="handleView()">Batal</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target="#modalCheckout"><i class="fa fa-paper-plane"></i> Checkount</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.borrows.getData') }}" width="100%">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title p-1"><i class="fa fa-book"></i> Data Buku</h2>
                <button class="float-right btn btn-default font-large-1" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table zero-configuration" id="tableBook" data-url="{{ route('admin.borrows.getDataBook') }}" width="100%">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCheckout" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-paper-plane"></i> Checkout</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tanggal Peminjaman</label>
                    <input type="text" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" id="date_of_return">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="btnCheckout"><i class="fa fa-paper-plane"></i> Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection