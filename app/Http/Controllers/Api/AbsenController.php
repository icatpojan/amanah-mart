<?php

namespace App\Http\Controllers\Api;

use App\Absen as AppAbsen;
use App\Http\Controllers\Controller;
use App\Model\Absen;
use App\Model\karyawan;
use App\Model\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index()
    {
        $Absen = Absen::all();
        if ($Absen == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia semau absen bos', $Absen, 200);
    }
    public function show($id)
    {
        $User = User::where('id', $id)->first();
        $Karyawan = karyawan::where('user_id', $User->id)->first();
        $telat = Absen::where('user_id', $id)->where('status', 3)->count();
        $hadir = Absen::where('user_id', $id)->where('status', '!=', 1)->count();
        $alpha = Absen::where('user_id', $id)->where('status', 1)->count();
        $kehadiran = Absen::where('user_id', $id)->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->where('status', 3)->get();
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse('07:00:00')));
        }
        return $this->sendResponse('Success', 'ini dia absen dan profil dia bos', compact('Karyawan', 'User','telat','hadir','alpha','totalJamTelat'), 200);
    }
    public function checkin()
    {
        $User = User::all();
        $cek = false;

        if (date('l') == 'Saturday' || date('l') == 'Sunday') {
            return $this->sendResponse('Failed', 'minggu minggu kok kerja', null, 400);
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
                    return $this->sendResponse('Failed', 'percuma absen, udah bukan waktunya', $Absen, 200);
                }
                $Absen->update($data);
                return $this->sendResponse('Success', 'berhasil absen anda wahai kasir', $Absen, 200);
            } else {
                return $this->sendResponse('Failed', 'gak usah kerajinan anda sudah absen hey', $Absen, 400);
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
        return $this->sendResponse('Success', 'berhasil absen anda wahai kasir', $Absen, 200);
    }

    public function checkout()
    {
        $kehadiran = Absen::where('user_id', Auth::id())->where('tanggal', date('Y-m-d'))->first();
        if ($kehadiran == null) {
            return $this->sendResponse('failed', 'masuk dulu baru absen pulang bos', null, 400);
        }
        if (strtotime(date('H:i:s')) < strtotime('17:00:00')) {
            return $this->sendResponse('failed', 'belom waktunya pulang bos', null, 400);
        }
        if ($kehadiran->jam_keluar != null) {
            return $this->sendResponse('failed', 'udah absen pulang sekali aja', null, 400);
        }
        $data['jam_keluar'] = date('H:i:s');
        $kehadiran->update($data);
        return $this->sendResponse('success', 'silakan pulang hey', $kehadiran, 200);
    }
}
