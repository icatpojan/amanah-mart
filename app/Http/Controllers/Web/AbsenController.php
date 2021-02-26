<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Absen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function checkin()
    {
        $User = User::all();
        $cek = false;

        if (date('l') == 'Saturday' || date('l') == 'Sunday') {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
        foreach ($User as $user) {
            $absen = Absen::where('user_id', $user->id)->where('tanggal', date('Y-m-d'))->first();
            if (!$absen) {
                $cek = true;
            }
        }

        if ($cek) {
            foreach ($User as $user) {
                if ($user->id != Auth::id()) {
                    Absen::create([
                        'status'    => '1',
                        'tanggal'   => date('Y-m-d'),
                        'user_id'   => $user->id
                    ]);
                }
            }
        }

        $Absen = Absen::where('user_id', Auth::id())->where('tanggal', date('Y-m-d'))->first();
        if ($Absen) {
            if ($Absen->status == 1) {
                $data['jam_masuk']  = date('H:i:s');
                $data['tanggal']    = date('Y-m-d');
                $data['user_id']    = Auth::id();
                if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
                    $data['status'] = 1;
                } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
                    $data['status'] = '3';
                } else {
                    $data['status'] = '1';
                    alert()->error('ErrorAlert', 'waktu absen sudah habis');
                    return back();
                }
                $Absen->update($data);
                alert()->success('SuccessAlert', 'sudah berhasil absen');
                return back();
            } else {
                alert()->error('sudahlah', 'anda sudah absen hey');
                return back();
            }
        }

        $data['jam_masuk']  = date('H:i:s');
        $data['tanggal']    = date('Y-m-d');
        $data['user_id']    = Auth::id();
        if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
            $data['status'] = 2;
        } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
            $data['status'] = 3;
        } else {
            $data['status'] = 1;
        }

        Absen::create($data);
        alert()->success('SuccessAlert', 'anda berhasil absen');
        return back();
    }
    public function checkout()
    {
        $kehadiran = Absen::where('user_id', Auth::id())->where('tanggal', date('Y-m-d'))->first();
        if ($kehadiran == null) {
            alert()->error('ErrorAlert', 'masuk dulu baru absen pulang bos');
            return back();
        }
        if (strtotime(date('H:i:s')) < strtotime('17:00:00')) {
            alert()->error('ErrorAlert', 'belom waktunya pulang bos');
            return back();
        }
        if ($kehadiran->jam_keluar != null) {
            alert()->error('ErrorAlert', 'absen pulang sekali aja kali');
            return back();
        }
        $data['jam_keluar'] = date('H:i:s');
        $kehadiran->update($data);
        alert()->success('SuccessAlert', 'silakan pulang hey');
        return back();
    }
}
