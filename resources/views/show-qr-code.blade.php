@extends('layouts.frontend')

@section('content')

<div class="col-md-4 col-sm-8 col-10 mx-auto my-5">
    <div class="card">
        <div class="card-body text-center">
            <h3 class="text-center mb-5">Scan QRCode</h3>
            {!! QrCode::size(250)->generate($transaction->transaction_code) !!}
            <a href="{{ route('booking.filter', 'waiting') }}" class="mt-5 btn btn-secondary w-100">Kembali</a>
        </div>
    </div>
</div>

@endsection