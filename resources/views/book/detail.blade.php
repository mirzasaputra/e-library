@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.books') }}" data-toggle="ajax">Data Buku</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="col-sm-10 mx-auto my-5">
            <div class="d-flex align-items-center justify-content-center py-5">
                <div class="col-md-5">
                    <div class="col-9 mx-auto mb-3">
                        <img src="{{ asset('storage/images/books/'. $data->picture) }}" alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-10 mb-3">
                        <span class="badge bg-primary small">{{ ucfirst($data->genre->name) }}</span>
                        <h3 class="mb-3">{{ $data->name }}</h3>
                        <p class="text-muted mb-4">{{ $data->description }}</p>
                        <table class="text-muted mb-3">
                            <tr>
                                <td class="pe-4">Tahun Terbit</td>
                                <td>: {{$data->publication_year}}</td>
                            </tr>
                            <tr>
                                <td>Penulis</td>
                                <td>: {{$data->author}}</td>
                            </tr>
                        </table>
                        <button class="btn btn-danger px-5" data-toggle="ajax" data-target="{{ route('admin.books') }}" style="border-radius: 25px;">Kembali</button>
                        <button class="btn btn-primary px-5" data-toggle="ajax" data-target="{{ route('admin.books.edit', $data->hashid) }}" style="border-radius: 25px;">Edit Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection