<?php

namespace App\Http\Controllers\BookReturn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionPenalty;
use DataTables;

class BookReturnController extends Controller
{
    
    public function index()
    {
        $transaction = Transaction::where('status', '=', 'not_be_restored')->get();
        $transaction = $transaction->map(function($data){
            if(strtotime($data->date_of_return) > strtotime(date('Y-m-d'))) {
                $late = 0;
            } else {
                $late = date_diff(date_create(date('Y-m-d')), date_create($data->date_of_return))->format("%a");
            }

            return [
                'hashid' => $data->hashid,
                'transaction_code' => $data->transaction_code,
                'date' => $data->date,
                'date_of_return' => $data->date_of_return,
                'late' => $late,
                'transactionDetail' => $data->transactionDetail,
            ];
        });

        $data = [
            'title' => 'Pengembalian',
            'data' => $transaction
        ];

        return customView('book-return.index', $data);
    }

    public function show(Transaction $transaction)
    {
        $data = [
            'title' => 'Detail',
            'mods' => 'book_return',
            'transaction' => $transaction,
            'late' => strtotime($transaction->date_of_return) > strtotime(date('Y-m-d')) ? 0 : date_diff(date_create(date('Y-m-d')), date_create($transaction->date_of_return))->format("%a")
        ];

        return customView('book-return.show', $data);
    }

    public function getDataDetail(Transaction $transaction)
    {
        return DataTables::of($transaction->transactionDetail()->with('book'))->addColumn('description', function($data){
            return strlen($data->book->description) > 150 ? substr($data->book->description, 0, 150) . '...' : $data->book->description;
        })->addColumn('genre', function($data){
            return $data->book->genre->name;
        })->make();
    }

    public function returned(TransactionDetail $transactionDetail)
    {
        try {
            $check = TransactionDetail::where('transaction_id', '=', $transactionDetail->transaction_id)->whereNull('date_of_return')->count();

            if($check == 1){
                $late = date_diff(date_create(date('Y-m-d')), date_create($transactionDetail->transaction->date_of_return))->format("%a");

                Transaction::find($transactionDetail->transaction_id)->update(['status' => 'returned']);
                TransactionPenalty::create([
                    'transaction_id' => $transactionDetail->transaction_id,
                    'late' => $late,
                    'amount' => $late * getSetting('app_money_fine')
                ]);
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

    public function viewQRCodeScanner()
    {
        $data = [
            'title' => 'Scan QRCode',
        ];

        return customView('book-return.qr-code-scanner', $data);
    }

    public function scanner($transaction_code)
    {
        $transaction = Transaction::where(['transaction_code' => $transaction_code, 'status' => 'not_be_restored']);

        if($transaction->count() > 0){
            return response()->json($transaction->first());
        } else {
            return response()->json([
                'message' => 'error'
            ], 500);
        }
    }   

}
