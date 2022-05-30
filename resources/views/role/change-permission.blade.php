@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.roles') }}" data-toggle="ajax">Roles</a>
    </li>
    <li class="breadcrumb-item active">Change Permission</li>
</ol>
@endsection

@section('content')

<div class="card shadow-sm p-3 mb-3">
    <div class="card-body">
        <form action="{{ route('admin.roles.update-permission', $id) }}" method="post" data-request="ajax"
            data-success-callback="{{ route('admin.roles') }}">
            @csrf

            <div class="row gy-4">
                <div class="col-md-12 text-center mb-5">
                    <div class="checkbox">
                        <input type="checkbox" class="form-check-input" id="uid">
                        <label class="form-check-label" for="uid">Semua Permission</label>
                    </div>
                </div>
                <div class="col">
                    <div class="row pl-4 pr-4">
                        @foreach ($permissions as $idx => $permission)
                            @if (getInfoLogin()->roles[0]['name'] == 'Developer')
                                <div class="col-md-3 col-sm-6" style="margin-bottom: 40px">
                                    @foreach ($permission as $singlePermission)
                                        <div class="form-check form-switch form-switch-md" dir="ltr">
                                            <input type="checkbox" class="uid form-check-input"
                                                id="uid-{{ $idx . '-' . $loop->iteration }}" name="permission[]"
                                                value="{{ $singlePermission }}"
                                                {{ $role->hasPermissionTo($singlePermission) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="uid-{{ $idx . '-' . $loop->iteration }}">{{ $singlePermission }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                @if (getInfoLogin()->roles[0]['name'] !== 'Developer' && $permission[0] !== 'read-permissions' && $permission[0] !== 'read-menus' && $permission[0] !== 'read-menu-groups' && $permission[0] !== 'read-sub-menus')
                                    <div class="col-md-3 col-sm-6" style="margin-bottom: 10px">
                                        @foreach ($permission as $singlePermission)
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input type="checkbox" class="uid form-check-input"
                                                    id="uid-{{ $idx . '-' . $loop->iteration }}" name="permission[]"
                                                    value="{{ $singlePermission }}"
                                                    {{ $role->hasPermissionTo($singlePermission) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="uid-{{ $idx . '-' . $loop->iteration }}">{{ $singlePermission }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="preview-hr">
            <div class="col-12 text-right">
                <button class="btn btn-secondary float-end mx-1" type="button" data-toggle="ajax" data-target="{{ route('admin.roles') }}"><i class="fa fa-arrow-left"></i> Kembali</button>
                <button class="btn btn-primary float-end" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection