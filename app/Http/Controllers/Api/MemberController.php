<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $User = User::where('role_id', 5)->get();
        if ($User == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar member bos', $User, 200);
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'string|required',
            'email' => 'string|required',
            'password' => 'integer|required',
            'umur' => 'integer|required',
            'address' => 'string|required'
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
        $Member = Member::where('user_id', $id)->first();
        $Member->update([
            'phone_number' => $request->phone_number == null ? $Member->phone_number : $request->phone_number,
            'umur' => $request->umur == null ? $Member->umur : $request->umur,
            'address' => $request->address == null ? $Member->address : $request->address,
        ]);
        try {
            $User->save();
            return $this->sendResponse('Success', 'berhasil mengupdate member bos', $User, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate member bos', null, 500);
        }
    }
    public function updateme(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        $User->update([
            'name' => $request->name == null ? $User->name : $request->name,
            'email' => $request->email == null ? $User->email : $request->email,
        ]);
        $Member = Member::where('user_id', Auth::user()->id)->first();
        $Member->update([
            'phone_number' => $request->phone_number == null ? $Member->phone_number : $request->phone_number,
            'umur' => $request->umur == null ? $Member->umur : $request->umur,
            'address' => $request->address == null ? $Member->address : $request->address,
        ]);
        try {
            $User->save();
            $Member->save();
            return $this->sendResponse('Success', 'berhasil mengupdate member bos', $User, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate member bos', null, 500);
        }
    }
    public function destroy($id)
    {
        $User = User::findOrfail($id);
        $User->delete();
        $Member = Member::where('user_id', $id)->first();
        $Member->delete();
        return $this->sendResponse('Success', 'member berhasil anda hapus bos', null, 200);
    }
    public function top_up(Request $request ,$id)
    {
        $Member = Member::findOrfail($id);
        $Member->delete();
        $Member = Member::where('member_id', $id)->first();
        $Member->saldo = $request->topup + $Member->saldo;
        $Member->update();
        return $this->sendResponse('Success', 'member top up berhasil', null, 200);
    }

}
