<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use App\Model\Tabungan;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin')->except('index', 'tabungan');
    // }
    public function index()
    {
        $User = User::all();
        return view('pages.karyawan', compact('User'));
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
