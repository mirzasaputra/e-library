@extends('layouts.ajax')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.bookings') }}" data-toggle="ajax">Pengambilan</a>
    </li>
    <li class="breadcrumb-item active">Scan QRCode</li>
</ol>
@endsection

@section('content')

<div class="card">
    <div class="card-body text-center">
        <div id="reader" class="mx-auto rounded" style="width: 600px;"></div>
        <div class="info-box mt-4">
            <h4 class="mt-4">Scan QR Code booking untuk melihat data buku.</h4>
        </div>
    </div>
</div>

@endsection

@section('_js')

<script>
    if (typeof html5QrcodeScanner == "undefined") {
        let html5QrcodeScanner = null
    }

    html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 30, qrbox: { width: 250, height: 250 } },
        false
    )

    html5QrcodeScanner.render(onScanSuccess, onScanFailure)
    $('#reader__dashboard_section_csr span button').hide()

    async function onScanSuccess(decodedText, decodedResult) {
        if(typeof decodeText != 'undefined' || decodedText != null){
            swal.fire({
                title: 'Please Wait',
                html: 'Processing',
                allowOutsideClick: false,
                didOpen: () => {
                    swal.showLoading()
                }
            })

            const res = await fetch(`${$('meta[name="base-url"]').attr('content')}/administrator/bookings/${decodedText}/scanner`)
    
            swal.close()
            if(res.status == 200){
                var data = await res.json()
                pushState(`${$('meta[name="base-url"]').attr('content')}/administrator/bookings/${data.hashid}/show`)
            } else {
                swal.fire({
                    title: 'Peringatan',
                    icon: 'warning',
                    text: 'QRCode tidak ditemukan'
                })
            }
        }
    }

    function onScanFailure(error) {
        // console.warn(`Code scan error = ${error}`)
    }
</script>

@endsection