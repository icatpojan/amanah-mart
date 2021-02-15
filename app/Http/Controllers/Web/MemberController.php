<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $Member = Member::all();
        return view('pages.member', compact('Member'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'email' => 'required|email|unique:users',
            'umur' => 'integer|required',
            'address' => 'string|required',
            'phone_number' => 'integer|required'
        ]);
        if ($validator->fails()) {
            alert()->error('ada yang salah dengan data anda');
            return back();
        }
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role_id' => 5,
        ]);
        $User->save();
        $User = User::latest()->first();
        $Member = Member::create([
            'umur' => $request->umur,
            'address' => $request->address,
            'user_id' => $User->id,
            'member_id' => rand(1000, 100000),
            'phone_number' => $request->phone_number,
        ]);
        try {
            $Member->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function update(Request $request, $id)
    {
        $Member = Member::where('user_id', $id)->first();
        $User = User::where('id', $id)->first();
        $User->update([
            'name' => $request->name,
        ]);
        $Member->update([
            'phone_number' => $request->phone_number,
            'umur' => $request->umur,
            'address' => $request->address,
        ]);
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
    public function destroy($id)
    {
        $User = User::findOrfail($id);
        $User->delete();
        $Member = Member::where('user_id', $id)->first();
        $Member->delete();
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
}
