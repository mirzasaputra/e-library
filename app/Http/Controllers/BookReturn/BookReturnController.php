<?php

namespace App\Http\Controllers\BookReturn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use DataTables;

class BookReturnController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Pengembalian',
            'data' => Transaction::where('status', '=', 'not_be_restored')->get()
        ];

        return customView('book-return.index', $data);
    }

    public function show(Transaction $transaction)
    {
        $data = [
            'title' => 'Detail',
            'mods' => 'book_return',
            'transaction' => $transaction,
        ];

        return customView('book-return.show', $data);
    }

    public function getDataDetail(Transaction $transaction)
    {
        return DataTables::of($transaction->transactionDetail()->with('book'))->addColumn('description', function($data){
            return strlen($data->book->description) > 150 ? substr($data->book->description, 0, 150) . '...' : $data->book->description;
        })->make();
    }

    public function returned(TransactionDetail $transactionDetail)
    {
        try {
            $check = TransactionDetail::where('transaction_id', '=', $transactionDetail->transaction_id)->whereNull('date_of_return')->count();

            if($check == 1){
                Transaction::find($transactionDetail->transaction_id)->update(['status' => 'returned']);
            }

            $transactionDetail->update([
                'date_of_return' => now()
            ]);

            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e){
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
