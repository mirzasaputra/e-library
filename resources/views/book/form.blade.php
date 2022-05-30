@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.books') }}" data-toggle="ajax">Buku</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')

<div class="col-md-6 col-sm-9">
    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="post" data-request="ajax" data-success-callback="{{ route('admin.books') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Tahun Terbit</label>
                    <input type="text" name="publication_year" id="publication_year" class="form-control" placeholder="Tahun Terbit" autocomplete="off" value="{{ isset($data) ? $data->publication_year : date('Y') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Penerbit</label>
                    <input type="text" name="author" class="form-control" placeholder="Penerbit" autocomplete="off" value="{{ isset($data) ? $data->author : '' }}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Dekripsi</label>
                    <textarea name="description" rows="4" class="form-control">{{ isset($data) ? $data->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Images</label>
                    <input type="file" name="file" class="form-control-file dropify">
                </div>
                <hr>
                <div class="col-12 text-end">
                    <button class="btn btn-danger" type="button" data-toggle="ajax" data-target="{{ route('admin.books') }}">Kembali</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('_js')
<script>
    $('.dropify').dropify()

    $('#publication_year').datepicker({
        format: 'yyyy',
        date: new Date()
    })
</script>
@endsection