<?php

namespace App\Http\Controllers\Borrow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Book;
use App\Models\Member;
use Vinkla\Hashids\Facades\Hashids;
use DataTables;

class BorrowController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Peminjaman',
            'mods' => 'borrow',
            'members' => Member::all(),
        ];

        return customView('borrow.index', $data);
    }

    public function getData()
    {
        return DataTables::of(TransactionDetail::whereHas('transaction', function($q){
            $q->where(['user_id' => getInfoLogin()->id, 'status' => 'pending']);
        }))->addColumn('name', function($data){
            return $data->book->name;
        })->addColumn('description', function($data){
            return strlen($data->book->description) > 150 ? substr($data->book->description, 0, 150) .'...' : $data->book->description;
        })->addColumn('publication_year', function($data){
            return $data->book->publication_year;
        })->addColumn('author', function($data){
            return $data->book->author;
        })->addColumn('picture', function($data){
            return $data->book->picture;
        })->addColumn('genre', function($data){
            return $data->book->genre->name;
        })->make();
    }

    public function getDataBook()
    {
        return DataTables::of(Book::all())->addColumn('genre', function($data){
            return $data->genre->name;
        })->make();
    }

    public function store($book_id)
    {
        try {
            $transaction = Transaction::where(['user_id' => getInfoLogin()->id, 'status' => 'pending']);
    
            if($transaction->count() > 0){
                $transaction = $transaction->first();
    
                $check = TransactionDetail::where(['transaction_id' => $transaction->id, 'book_id' => Hashids::decode($book_id)[0]]);
                
                if($check->count() <= 0){
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'book_id' => Hashids::decode($book_id)[0]
                    ]);
                }
            } else {
                $transaction = Transaction::create([
                    'user_id' => getInfoLogin()->id,
                    'status' => 'pending'
                ]);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'book_id' => Hashids::decode($book_id)[0]
                ]);
            }

            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'date_of_return' => 'required'
        ]);

        try {
            $transaction = Transaction::where(['user_id' => getInfoLogin()->id, 'status' => 'pending']);
    
            if($transaction->count() > 0){
                $transaction->update([
                    'member_id' => Hashids::decode($request->member_id)[0],
                    'date_of_return' => $request->date_of_return,
                    'status' => 'not_be_restored'
                ]);
    
                return response()->json([
                    'message' => 'Data telah disimpan'
                ]);
            } else {
                return response()->json([
                    'message' => 'Opps! terjadi kesalahan'
                ], 500);
            }
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }

    public function destroy(TransactionDetail $transactionDetail)
    {
        try {
            $transactionDetail->delete();

            return response()->json([
                'message' => 'Data telah dihapus'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

}
