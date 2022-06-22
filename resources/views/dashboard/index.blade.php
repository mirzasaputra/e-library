@extends('layouts.ajax')

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="card-body-icon bg-rgba-warning">
                    <i class="feather icon-repeat font-medium-5 text-warning"></i>
                </div>
                <div class="ml-1">
                    <p class="text-warning pb-0 mb-0">Transaksi Hari Ini</p>
                    <h2 class="font-weight-700 pb-0 mb-0">{{ $transactionToday->count() }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="card-body-icon bg-rgba-primary">
                    <i class="feather icon-book font-medium-5 text-primary"></i>
                </div>
                <div class="ml-1">
                    <p class="text-primary pb-0 mb-0">Data Buku</p>
                    <h2 class="font-weight-700 pb-0 mb-0">{{ $books->count() }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="card-body-icon bg-rgba-danger">
                    <i class="feather icon-alert-triangle font-medium-5 text-danger"></i>
                </div>
                <div class="ml-1">
                    <p class="text-danger pb-0 mb-0">Data Anggota</p>
                    <h2 class="font-weight-700 pb-0 mb-0">{{ $members->count() }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="card-body-icon bg-rgba-success">
                    <i class="feather icon-users font-medium-5 text-success"></i>
                </div>
                <div class="ml-1">
                    <p class="text-success pb-0 mb-0">Users</p>
                    <h2 class="font-weight-700 pb-0 mb-0">{{ $users->count() }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection