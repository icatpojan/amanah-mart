<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use App\Karyawan as AppKaryawan;
use App\Model\karyawan;
use App\Model\Tabungan;
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
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withToastError($validator->messages()->all()[0])->withInput();
        }
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        $User->save();
        $Karyawan = karyawan::create([
            'umur' => $request->umur,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'user_id' => $User->id
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
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('ada yang salah dengan data anda');
            return back();
        }
        $User = User::where('id', $id)->first();
        $User->update([
            'name' => $request->name,
        ]);

        $Karyawan = Karyawan::where('user_id', $id)->first();
        $Karyawan->update([
            'umur' => $request->umur,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
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
