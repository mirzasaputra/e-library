<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Vinkla\Hashids\Facades\Hashids;

class BookingController extends Controller
{
    
    public function index($status = null)
    {
        $status = $status ?? 'pending';
        $transaction = Transaction::where(['member_id' => getInfoLogin()->member_id, 'status' => $status]);
        $data = [
            'title' => 'Data Booking',
            'status' => $status,
            'data' => $status == 'waiting' ? $transaction->get() : $transaction->first()
        ];

        return view('booking', $data);
    }

    public function store($book_id)
    {
        try {
            $transaction = Transaction::where(['member_id' => getInfoLogin()->member_id, 'status' => 'pending']);

            if($transaction->count() > 0){
                $transaction = $transaction->first();
            } else {
                $transaction = Transaction::create([
                    'member_id' => getInfoLogin()->member_id,
                    'status' => 'pending'
                ]);
            }
            
            $check = TransactionDetail::where(['transaction_id' => $transaction->id, 'book_id' => Hashids::decode($book_id)[0]]);

            if($check->count() <= 0){
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'book_id' => Hashids::decode($book_id)[0]
                ]);
            }

            return redirect()->route('booking');
        } catch(Exception $e){
            return redirect()->withErrors(['message' => $e->getMessage]);
        }
    }

    public function destroy(TransactionDetail $transactionDetail)
    {
        try {
            $transactionDetail->delete();

            return redirect()->route('booking');
        } catch(Exception $e){
            return redirect()->withErrors(['message' => $e->getMessage]);
        }
    }

    public function checkoutShow()
    {
        $data = [
            'title' => 'Checkout',
            'data' => Transaction::where(['member_id' => getInfoLogin()->member_id, 'status' => 'pending'])->first()
        ];

        return view('checkout', $data);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'date_of_return' => 'required'
        ]);

        try {
            $count = Transaction::where('date', date('Y-m-d'))->count();
            $trx =  'TRX-'. date('Ymd') .'-'. sprintf("%03d", $count == 0 ? 1 : $count + 1);
            Transaction::where(['member_id' => getInfoLogin()->member_id, 'status' => 'pending'])->update([
                'transaction_code' => $trx,
                'date' => date('Y-m-d'),
                'date_of_return' => $request->date_of_return,
                'status' => 'waiting'
            ]);

            return redirect()->route('booking', 'waiting');
        } catch(Exception $e){
            return redirect()->withErrors(['message' => $e->getMessage]);
        }
    }

    public function showQrCode(Transaction $transaction)
    {
        $data = [
            'title' => 'Show QR Code',
            'transaction' => $transaction
        ];

        return view('show-qr-code', $data);
    }

}
