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

<div class="col-md-4 col-sm-6">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.reports.preview') }}" target="_blank">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="text" name="date" class="form-control" id="daterangepicker" placeholder="Tanggal">
                </div>
                <hr>
                <div class="col-12 text-right">
                    <button class="btn btn-primary"><i class="feather icon-printer"></i> Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('_js')
<script>
    $(document).ready(function() {
        $('#daterangepicker').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            }
        });
    });
</script>
@endsection