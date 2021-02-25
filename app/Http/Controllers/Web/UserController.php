<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use App\Karyawan as AppKaryawan;
use App\Model\karyawan;
use App\Model\Tabungan;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $User = karyawan::with(['user'])->get();
        return view('pages.karyawan', compact('User'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'phone_number'  => 'required',
            'role_id'   => 'required',
            'password'  => 'required',
            'address'   => 'required',
            'image' => 'image|mimes:png,jpeg,jpg',
        ]);
        if ($validator->fails()) {
            return back()->withToastError($validator->messages()->all()[0])->withInput();
        }
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        $User->save();
        $image = 'https://via.placeholder.com/150';
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

        $Karyawan = karyawan::create([
            'umur' => $request->umur,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'user_id' => $User->id,
            'image' => $image
        ]);
        try {
            $Karyawan->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'phone_number'  => 'required',
            'umur'  => 'required',
            'address'   => 'required',
            'image' => 'image|mimes:png,jpeg,jpg',
        ]);
        if ($validator->fails()) {
            return back()->withToastError($validator->messages()->all()[0])->withInput();
        }

        $User = User::where('id', $id)->first();
        $User->update([
            'name' => $request->name,
        ]);
        $Karyawan = Karyawan::where('user_id', $id)->first();
        if ($request->image == null) {
            $image = $Karyawan->image;
        }
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
            'umur' => $request->umur,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'image' => $image,
        ]);
        try {
            $Karyawan->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }

    public function show($id)
    {
        $data = Karyawan::find($id);
        echo json_encode($data);
    }
    public function blacklist()
    {
        $User = User::onlyTrashed()->get();
        return view('pages.blacklist', compact('User'));
    }

    public function destroy($id)
    {
        $User = User::findOrfail($id);
        $User->delete();
        $Karyawan = Karyawan::where('user_id', $id)->first();
        $Karyawan->delete();
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
}
