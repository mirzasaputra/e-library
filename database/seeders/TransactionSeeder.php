<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction = Transaction::create([
            'member_id' => 1,
            'status' => 'pending'
        ]);

        TransactionDetail::insert([
            [
                'transaction_id' => $transaction->id,
                'book_id' => 1
            ],
            [
                'transaction_id' => $transaction->id,
                'book_id' => 2
            ],
        ]);
    }
}
