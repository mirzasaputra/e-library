@extends('layouts.frontend')

@section('content')

<div class="container my-5">
    <h3 class="mb-5">Data Booking</h3>
    @error('message')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <div class="row">
        <div class="col-sm-6">
            @if($status == 'pending')
                <a href="{{ route('katalog') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>
                <a href="{{ route('booking.checkout') }}" class="btn btn-warning mb-3"><i class="fa fa-paper-plane"></i> Checkout</a>
            @endif
        </div>
        <div class="col-sm-6">
            <div class="col-md-8 col-sm-10 col-12 ms-auto mb-3">
                <select name="" class="form-control select2" id="changeStatus">
                    <option value="pending" {{ isset($status) && $status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="waiting" {{ isset($status) && $status == 'waiting' ? 'selected' : '' }}>Menunggu Diambil</option>
                    <option value="not_be_restored" {{ isset($status) && $status == 'not_be_restored' ? 'selected' : '' }}>Belum Dikembalikan</option>
                </select>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" width="100%">
            @if($status == 'pending')
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
            @endif
    
            @if($status == 'waiting')
                <tr>
                    <th width="1%" class="p-3">No.</th>
                    <th class="p-3">Kode Transaksi</th>
                    <th class="p-3">Tanggal Peminjaman</th>
                    <th class="p-3">Tanggal Pengembalian</th>
                    <th class="p-3">Jumlah Buku</th>
                    <th class="p-3">Status</th>
                    <th width="250" class="p-3"></th>
                </tr>
                @if(!is_null($data) && $data->count() > 0)
                    @foreach($data as $item)
                        <tr>
                            <td valign="middle" align="center">{{ $loop->iteration }}</td>
                            <td>{{ $item->transaction_code }}</td>
                            <td>{{ date('D, d M Y', strtotime($item->date)) }}</td>
                            <td>{{ date('D, d M Y', strtotime($item->date_of_return)) }}</td>
                            <td>{{ $item->transactionDetail->count() }}</td>
                            <td><i class="badge bg-warning">Menunggu Pengambilan</i></td>
                            <td valign="middle" align="center">
                                <a href="{{ route('booking.showQrCode', $item->hashid) }}" class="btn btn-primary btn-sm">Show QRCode</a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">
                            <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="40%">
                            <h5 class="text-center text-primary mb-4" style="margin-top: -40px;">No Result Found.</h5>
                        </td>
                    </tr>
                @endif
            @endif
    
            @if($status == 'not_be_restored')
                <tr>
                    <th width="1%" class="p-3">No.</th>
                    <th class="p-3">Kode Transaksi</th>
                    <th class="p-3">Tenggat Waktu</th>
                    <th class="p-3">Jumlah Buku</th>
                    <th width="250" class="p-3"></th>
                </tr>
                @if(!is_null($data) && $data->count() > 0)
                    @foreach($data as $item)
                        <tr>
                            <td valign="middle" align="center">{{ $loop->iteration }}</td>
                            <td>{{ $item->transaction_code }}</td>
                            <td>{{ date('D, d M Y', strtotime($item->date_of_return)) }}</td>
                            <td>{{ $item->transactionDetail->count() }}</td>
                            <td valign="middle" align="center">
                                <a href="{{ route('booking.showQrCode', $item->hashid) }}" class="btn btn-warning btn-sm">Lihat Detail</a>
                                <a href="{{ route('booking.showQrCode', $item->hashid) }}" class="btn btn-primary btn-sm">Show QRCode</a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">
                            <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="40%">
                            <h5 class="text-center text-primary mb-4" style="margin-top: -40px;">No Result Found.</h5>
                        </td>
                    </tr>
                @endif
            @endif
        </table>
    </div>
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

    $('#changeStatus').change(function(e){
        window.location.assign(`${$('meta[name="base-url"]').attr('content')}/booking/${$(this).val()}/filter`)
    })
</script>
@endsection