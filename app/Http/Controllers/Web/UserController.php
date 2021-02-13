<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Role;
use App\karyawan;
use App\Model\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin')->except('index', 'tabungan');
    // }
    public function index()
    {
        $User = User::all()->with(['Role']);
        return view('pages.karyawan', compact('User'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'phone_number'  => 'required|min:6',
            'role_id'   => 'required',
            'password'  => 'required',
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('ada yang salah dengan data anda');
            return back();
        }
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 5,
        ]);

        $Karyawan = karyawan::create([
            'umur' => $request->umur,
            'address' => $request->address,
        ]);
        try {
            $Karyawan->save();
            $User->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }

    public function blacklist()
    {
        $users = User::onlyTrashed()->get();
        return view('pages.blacklist', compact('users'));
    }

    public function softDelete($id)
    {
        $user = User::findOrfail($id);

        $user->delete();
        return back();
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();
        return back();
    }

    public function delete($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->forceDelete();
        return back();
    }
}
