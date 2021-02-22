<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    // Catatan carbon
    public function coba()
    {
        $mytime = Carbon::now()->addDays(); // + 1 hari
        $mytime = Carbon::now()->subWeek(); // - 1 minggu
        $mytime = Carbon::now()->isSunday(); // adalah minggu
        $mytime = Carbon::createFromDate(1975, 5, 21)->age; // ngitung umur
        $mytime = Carbon::createFromTimestamp(0)->diffInSeconds(); //dari buat carbon
        $from = '2021-02-20';
        $to = '2021-02-20' + date(7 * 24 * 60 * 60);
        $User = $mytime;
        $User = User::where('created_at', '2018-10-21')->get(); // jangan lupa di get() BOS
        $User = User::whereBetween('created_at',[$from,$to])->get(); // jangan lupa di get() BOS

        return response()->json(compact('User'));
    }
}
