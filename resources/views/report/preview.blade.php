<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Peminjaman Buku</title>
    
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 13px;
            vertical-align: top;
        }
        
        .table th {
            background-color: #f2f2f2;
            font-size: 14px;
        }
        
        .table tr:nth-child(even){
            background-color: #ffffff;
        }

        .p-0 {
            padding: 0;
        }

        .m-0 {
            margin: 0;
        }

        .ml-4 {
            margin-left: 3rem;
        }
        
        p {
            font-size: 15px;
        }

        .text-center {
            text-align: center;
        }


    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td>
                <img src="{{ public_path('storage/images/'. getSetting('app_favicon')) }}" alt="{{ getSetting('app_name') }}" width="50">
            </td>
            <td>
                <h2 class="p-0 m-0">{{ getSetting('app_name') }}</h3>
                <p class="p-0 m-0">{{ getSetting('app_address') }}</p>
                <p class="p-0 m-0">
                    <span>Telp : {{ getSetting('app_phone') }}</span>
                    <span class="ml-4">Email : {{ getSetting('app_email') }}</span>
                </p>
            </td>
        </tr>
    </table>
    <hr>
    <h3 class="text-center m-0 p-0">Laporan Penjualan</h3>
    <br>
    <br>
    <p class="p-0 m-0">Periode : {{ date('d M Y', strtotime($date_start)) }} - {{ date('d M Y', strtotime($date_start)) }}</p>
    <p class="p-0 m-0">Dicetak Pada : {{ date('d M Y | H:i') }}</p>
    <br>
    <table class="table">
        <tr>
            <th>No.</th>
            <th>Kode Transaksi</th>
            <th>Nama Anggota</th>
            <th>Buku</th>
            <th>Jumlah Denda</th>
        </tr>
        @php $total = 0 @endphp
        @foreach($transaction as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->transaction_code }}</td>
                <td>{{ $item->member->name }}</td>
                <td>
                    <ul style="margin: 0;padding: 0;padding-left: 20px;">
                        @foreach($item->transactionDetail as $i)
                        <li style="padding-bottom: 8px;">
                            <strong>{{ $i->book->name }}</strong>
                            <p class="p-0 m-0">Penulis : {{ $i->book->author }}</p>
                        </li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp. {{ number_format($item->transactionPenalty->amount, 0, ',', '.') }}</td>
                @php $total += $item->transactionPenalty->amount @endphp
            </tr>
        @endforeach
        <tr>
            <th colspan="4">Total</th>
            <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>