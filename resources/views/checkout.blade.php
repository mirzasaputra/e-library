@extends('layouts.frontend')

@section('content')

<div class="container my-4">
    <h3>{{ $title }}</h3>
    <div class="col-md-6 col-sm-8 col-12">
        <div class="card mt-2">
            <div class="card-body">
                <form action="{{ route('booking.checkout.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama" value="{{ $data->member->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $data->member->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">No. Telp</label>
                        <input type="text" name="phone" class="form-control" placeholder="No. Telp" value="{{ $data->member->phone }}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tanggal Peminjaman</label>
                                <input type="date" name="date" class="form-control" placeholder="Tanggal Peminjaman" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tanggal Pengembalian</label>
                                <input type="date" name="date_of_return" class="form-control" placeholder="Tanggal Pengembalian">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection