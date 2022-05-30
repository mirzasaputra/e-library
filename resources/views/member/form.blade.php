@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.members') }}" data-toggle="ajax">Members</a>
    </li>
    <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
@endsection

@section('content')

<div class="col-md-6 col-sm-8 col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="post" data-request="ajax" data-success-callback="{{ route('admin.members') }}">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">No. Telp</label>
                    <input type="text" name="phone" class="form-control" placeholder="No. Telp" autocomplete="off" value="{{ isset($data) ? $data->phone : '' }}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" autocomplete="off" value="{{ isset($data) ? $data->email : '' }}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Alamat</label>
                    <textarea name="address" rows="4" class="form-control">{{ isset($data) ? $data->address : '' }}</textarea>
                </div>
                <hr>
                <div class="form-group text-right">
                    <button class="btn btn-danger" type="button" data-toggle="ajax" data-target="{{ route('admin.users') }}">Kembali</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection