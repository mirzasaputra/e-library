<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Vinkla\Hashids\Facades\Hashids;

class BookingController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Data Booking',
            'data' => Transaction::where(['member_id' => getInfoLogin()->member_id, 'status' => 'pending'])->first()
        ];

        return view('booking', $data);
    }

    public function store($book_id)
    {
        try {
            $transaction = Transaction::where('member_id', getInfoLogin()->member_id);

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

}
