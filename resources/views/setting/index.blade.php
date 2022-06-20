@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table zero-configuration" id="dataTable" data-url="{{ route('admin.settings.getData') }}" width="100%">
            <thead>
                <th>No.</th>
                <th>Type</th>
                <th>Name</th>
                <th>Value</th>
                <th></th>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" data-request="ajax">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title"><i class="feather icon-edit-2"></i> Edit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" readonly>
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" name="value" class="form-control" placeholder="Value" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-pla"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection