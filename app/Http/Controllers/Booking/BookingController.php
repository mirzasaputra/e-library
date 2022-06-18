<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use DataTables;

class BookingController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Peminjaman',
            'bookings' => Transaction::where('status', '=', 'waiting')->get()
        ];

        return customView('booking.index', $data);
    }

    public function show(Transaction $transaction)
    {
        $data = [
            'title' => 'Detail',
            'mods' => 'booking',
            'transaction' => $transaction
        ];

        return customView('booking.show', $data);
    }

    public function getDataDetail(Transaction $transaction)
    {
        return DataTables::of($transaction->transactionDetail()->with('book'))->addColumn('description', function($data){
            return strlen($data->book->description) > 150 ? substr($data->book->description, 0, 150) . '...' : $data->book->description;
        })->make();
    }

    public function confirm(Transaction $transaction)
    {
        try {
            $transaction->update([
                'user_id' => getInfoLogin()->id,
                'status' => 'not_be_restored',
            ]);

            return response()->json([
                'message' => 'Peminjaman berhasil dikonfirmasi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function viewQRCodeScanner()
    {
        $data = [
            'title' => 'Scan QRCode',
        ];

        return customView('booking.qr-code-scanner', $data);
    }

    public function scanner($transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code);

        if($transaction->count() > 0){
            return response()->json($transaction->first());
        } else {
            return response()->json([
                'message' => 'error'
            ], 500);
        }
    }

}
