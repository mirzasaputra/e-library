@extends('layouts.frontend')

@section('content')

<div class="container my-5">
    <h3 class="mb-5">Data Booking</h3>
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ route('katalog') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>
            <a href="{{ route('booking') }}" class="btn btn-warning mb-3"><i class="fa fa-paper-plane"></i> Checkout</a>
        </div>
        <div class="col-sm-6">
            <div class="col-md-8 col-sm-10 col-12 ms-auto">
                <select name="" id="" class="form-control select2">
                    <option value="pending">Pending</option>
                    <option value="pending">Menunggu Diambil</option>
                    <option value="pending">Belum Dikembalikan</option>
                </select>
            </div>
        </div>
    </div>
    <table class="table" width="100%">
        <tr>
            <th width="1%" class="p-3">No.</th>
            <th class="p-3">Nama</th>
            <th width="250" class="p-3"></th>
        </tr>
        @if(!is_null($data) && $data->transactionDetail->count() > 0)
            @foreach($data->transactionDetail as $item)
                <tr>
                    <td valign="middle" align="center">{{ $loop->iteration }}</td>
                    <td>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <div class="col-1">
                                    <img src="{{ asset('storage/images/books/'. $item->book->picture) }}" alt="" width="100%">    
                                </div>
                                <div class="col-9 ms-3">
                                    <strong>{{ $item->book->name }}</strong>
                                    <p class="p-0 m-0 mt-2 text-muted small">{{ substr($item->book->description, 0, 200) }}...</p>
                                </div>
                            </div>    
                        </div>    
                    </td>
                    <td valign="middle" align="center">
                        <a href="{{ route('booking.delete', $item->hashid) }}" class="btn btn-outline-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3" class="text-center">
                    <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="40%">
                    <h5 class="text-center text-primary mb-4" style="margin-top: -40px;">No Result Found.</h5>
                </td>
            </tr>
        @endif
    </table>
</div>

@endsection

@section('_js')
<script>
    $('.delete').unbind().on('click', function(e){
        e.preventDefault()
        swal.fire({
            title: 'Delete?',
            icon: 'question',
            text: 'Yakin ingin menghapus data?',
            showConfirmButton: true,
            confirmButtonText: 'Ya, hapus',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then(res => {
            if(res.isConfirmed){
                window.location.assign($(e.target).attr('href'));
            }
        })
    })

    $('.select2').select2()
</script>
@endsection