@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.users') }}" data-toggle="ajax">Users</a>
    </li>
    <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
@endsection

@section('content')

<div class="col-md-6 col-sm-8 col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="post" data-request="ajax" data-success-callback="{{ route('admin.users') }}">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" autocomplete="off" value="{{ isset($data) ? $data->email : '' }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" value="{{ isset($data) ? $data->username : '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" {{ isset($data) ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off" {{ isset($data) ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="">Pilih Roles</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ isset($data) && $data->roles[0]->name == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
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