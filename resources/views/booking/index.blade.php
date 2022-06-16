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
                <a class="nav-link" href="" data-toggle="ajax">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="" data-toggle="ajax">Booking</a>
            </li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6 d-flex align-items-center justify-content-center mx-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari transaksi booking..">
                    <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="ml-1">
                    <button class="btn btn-secondary" style="white-space: nowrap;">Scan QRCode</button>
                </div>
            </div>
        </div>
        <div class="col-4 mx-auto mb-3">
            <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="100%">
            <h5 class="text-primary text-center">No Result Found.</h5>
        </div>
    </div>
</div>