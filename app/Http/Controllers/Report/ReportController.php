<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use PDF;

class ReportController extends Controller
{
    
    public function index() 
    {
        $data = [
            'title' => 'Laporan',
        ];
        
        return customView('report.index', $data);
    }

    public function preview(Request $request)
    {
        date_default_timezone_set('asia/jakarta');
        $date = explode(' - ', $request->date);
        $date_start = date('Y-m-d', strtotime($date[0]));
        $date_end = date('Y-m-d', strtotime($date[1]));

        $transaction = Transaction::whereBetween('date', [$date_start, $date_end])->where('status', 'returned')->get();

        $pdf = PDF::loadView('report.preview', compact('transaction', 'date_start', 'date_end'));
        return $pdf->stream('laporan_tanggal_'. $date_start .'_sampai_'. $date_end .'.pdf');
    }

}
