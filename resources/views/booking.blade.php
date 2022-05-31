@extends('layouts.frontend')

@section('content')

<div class="container my-5">
    <h3 class="mb-5">Data Booking</h3>
    <button class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</button>
    <table class="table table-bordered" width="100%">
        <tr>
            <th width="1%" class="p-3">No.</th>
            <th class="p-3">Nama</th>
            <th class="p-3">Qty</th>
            <th width="250" class="p-3"></th>
        </tr>
        <tr>
            <td colspan="4" class="text-center">
                <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="40%">
                <h5 class="text-center text-primary mb-4" style="margin-top: -40px;">No Result Found.</h5>
            </td>
        </tr>
    </table>
</div>

@endsection