<?php

namespace App\Http\Controllers;

use App\Models\SmsMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function index()
    {

        $year = Carbon::now()->year;

        $stats = SmsMessage::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total'),
            DB::raw('sum(is_sent) as success')
        )
        ->whereYear('created_at', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $months = [
            "Jan","Fev","Mar","Avr","Mai","Jun",
            "Jul","Aou","Sep","Oct","Nov","Dec"
        ];

        $totalData = array_fill(0,12,0);
        $successData = array_fill(0,12,0);

        foreach($stats as $stat){
            $index = $stat->month - 1;
            $totalData[$index] = $stat->total;
            $successData[$index] = $stat->success;
        }

        $sms = SmsMessage::where('sent_by_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $totalSms = SmsMessage::where('is_deleted',0)->count();
        $sentSms = SmsMessage::where('is_deleted',0)
                    ->where('is_sent',1)
                    ->count();
        $failedSms = SmsMessage::where('is_deleted',0)
                    ->where('is_sent',0)
                    ->count();

        return view('default.index', compact(
            'months',
            'totalData',
            'successData',
            'sms',
            'totalSms',
            'sentSms',
            'failedSms'
        ));
    }
}
