<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\karyawan;
use App\Model\Absen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        //menghitung jam telat
        $kehadiran = Absen::where('user_id', Auth::id())->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->where('status', 3)->get();
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse('07:00:00')));
        }

        // hitung alpha masuk telat
        $Alpha = Absen::where('user_id', Auth::id())->where('status', 1)->count();
        $Masuk = Absen::where('user_id', Auth::id())->where('status', 2)->count();
        $Telat = Absen::where('user_id', Auth::id())->where('status', 3)->count();

        // mengambil data absen hari ini
        $present = Absen::where('user_id', Auth::id())->where('tanggal', date('Y-m-d'))->first();
        $User = User::where('id', Auth::id())->first();

        $Karyawan = karyawan::where('user_id', $User->id)->first();

        return view('pages.home', compact('Karyawan', 'present', 'Alpha', 'Masuk', 'Telat', 'totalJamTelat'));
    }
    public function kasir()
    {
        return view('pages.kasir.home');
    }
}
