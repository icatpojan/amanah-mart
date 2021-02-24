<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Member;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    public function index()
    {
        $Member = Member::with(['user'])->get();
        if ($Member == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar member bos', $Member, 200);
    }
    public function me()
    {
        $Member = Member::where('user_id', Auth::id())->with(['user'])->get();
        if ($Member == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia data member andabos', $Member, 200);
    }
    public function register_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $User = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => 5
        ]);

        $User->save();
        $member = Member::create([
            'user_id' => $User->id,
            'member_id' => rand(10, 10000)
        ]);
        $User->sendEmailVerificationNotification();
        return response()->json([
            'status' => 'success',
            'message' => 'silakan verivikasi',
        ]);
    }

    public function update(Request $request, $id)
    {
        $User = User::where('id', $id)->first();
        $User->update([
            'name' => $request->name == null ? $User->name : $request->name,
            'email' => $request->email == null ? $User->email : $request->email
        ]);
        $Member = Member::where('user_id', $id)->first();
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
        $Member->update([
            'phone_number' => $request->phone_number == null ? $Member->phone_number : $request->phone_number,
            'umur' => $request->umur == null ? $Member->umur : $request->umur,
            'address' => $request->address == null ? $Member->address : $request->address,
            'image' => $request->image == null ? $Member->image : $image,
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
        $Member->update([
            'phone_number' => $request->phone_number == null ? $Member->phone_number : $request->phone_number,
            'umur' => $request->umur == null ? $Member->umur : $request->umur,
            'address' => $request->address == null ? $Member->address : $request->address,
            'image' => $request->image == null ? $Member->image : $image,
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
    public function topup(Request $request, $id)
    {
        $Member = Member::where('member_id', $id);
        if ($Member == null) {
            return $this->sendResponse('failed', 'member tidak ada', null, 400);
        }
        $Member = Member::where('member_id', $id)->first();
        $Member->saldo = $request->topup + $Member->saldo;
        $Member->update();
        return $this->sendResponse('Success', 'member top up berhasil', null, 200);
    }
}
