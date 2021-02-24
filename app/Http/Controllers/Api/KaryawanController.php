<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Absen;
use App\Model\karyawan;
use App\Model\Member;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function user()
    {
        $User = User::all();
        return $this->sendResponse('Success', 'ini dia User anda bos', $User, 200);
    }
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $Karyawan = karyawan::where('user_id', $user->id)->first();
        $telat = Absen::where('user_id', Auth::id())->where('status', 3)->count();
        $hadir = Absen::where('user_id', Auth::id())->where('status', '!=', 1)->count();
        $alpha = Absen::where('user_id', Auth::id())->where('status', 1)->count();
        $kehadiran = Absen::where('user_id', Auth::id())->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->where('status', 3)->get();
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse('07:00:00')));
        }
        return $this->sendResponse('Success', 'ini dia profil karyawan bos', compact('Karyawan', 'User', 'telat', 'hadir', 'alpha', 'totalJamTelat'), 200);
    }
    public function karyawan()
    {
        $Karyawan = karyawan::with(['user'])->get();
        return $this->sendResponse('Success', 'ini dia karyawan anda bos', $Karyawan, 200);
    }
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (empty($user)) {
            return response('silakan login terlebih dahulu bos');
        }
        if ($user->role_id == 5) {
            $User = User::where('id', Auth::id())->first();
            $Member = Member::where('user_id', $user->id)->first();
            return $this->sendResponse('Success', 'ini dia profil anda bos', compact('Member', 'User'), 200);
        } else {
            $user = User::where('id', Auth::user()->id)->first();
            $Karyawan = karyawan::where('user_id', $user->id)->first();
            $telat = Absen::where('user_id', Auth::id())->where('status', 3)->count();
            $hadir = Absen::where('user_id', Auth::id())->where('status', '!=', 1)->count();
            $alpha = Absen::where('user_id', Auth::id())->where('status', 1)->count();
            $kehadiran = Absen::where('user_id', Auth::id())->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->where('status', 3)->get();
            $totalJamTelat = 0;
            foreach ($kehadiran as $present) {
                $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse('07:00:00')));
            }
            return $this->sendResponse('Success', 'ini dia profil anda bos', compact('Karyawan', 'User', 'telat', 'hadir', 'alpha', 'totalJamTelat'), 200);
        }
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'string|required',
            'email' => 'string|required',
            'password' => 'integer|required',
            'umur' => 'integer|required',
            'address' => 'string|required',
            'phone_number' => 'string|required',
            'umur' => 'string|required'
        ]);
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 5,
        ]);
        $User->save();
        $User = User::latest()->first();
        $Member = Member::create([
            'user_id' => $User->id,
            'member_id' => rand(1000, 100000),
            'phone_number' => $request->phone_number,
            'umur' => $request->umur,
            'address' => $request->address,
        ]);

        try {
            $Member->save();
            return $this->sendResponse('Success', 'berhasil menambahkan member bos', $User, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menambahkan member bos', null, 500);
        }
    }
    public function update(Request $request, $id)
    {
        $User = User::where('id', $id)->first();
        $User->update([
            'name' => $request->name == null ? $User->name : $request->name,
            'email' => $request->email == null ? $User->email : $request->email
        ]);
        $Karyawan = Karyawan::where('user_id', $id)->first();
        if ($request->image) {
            $img = base64_encode(file_get_contents($request->image));
            $client = new Client();
            $res = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $img,
                    'format' => 'json',
                ]
            ]);
            $array = json_decode($res->getBody()->getContents());
            $image = $array->image->file->resource->chain->image;
        }
        $Karyawan->update([
            'phone_number' => $request->phone_number == null ? $Karyawan->phone_number : $request->phone_number,
            'umur' => $request->umur == null ? $Karyawan->umur : $request->umur,
            'address' => $request->address == null ? $Karyawan->address : $request->address,
            'image' => $request->image == null ? $Karyawan->image : $image,
        ]);
        try {
            $User->save();
            return $this->sendResponse('Success', 'berhasil mengupdate karyawan bos', $User, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate karyawan bos', null, 500);
        }
    }
    public function updateme(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        $User->update([
            'name' => $request->name == null ? $User->name : $request->name,
            'email' => $request->email == null ? $User->email : $request->email,
        ]);
        $Karyawan = Karyawan::where('user_id', Auth::user()->id)->first();
        if ($request->image) {
            $img = base64_encode(file_get_contents($request->image));
            $client = new Client();
            $res = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $img,
                    'format' => 'json',
                ]
            ]);
            $array = json_decode($res->getBody()->getContents());
            $image = $array->image->file->resource->chain->image;
        }
        $Karyawan->update([
            'phone_number' => $request->phone_number == null ? $Karyawan->phone_number : $request->phone_number,
            'umur' => $request->umur == null ? $Karyawan->umur : $request->umur,
            'address' => $request->address == null ? $Karyawan->address : $request->address,
            'image' => $request->image == null ? $Karyawan->image : $image,
        ]);
        try {
            $User->save();
            $Karyawan->save();
            return $this->sendResponse('Success', 'berhasil mengupdate diri  sendiri bos', $User, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate diri sendiri bos', null, 500);
        }
    }
}
