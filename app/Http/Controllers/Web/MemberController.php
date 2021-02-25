<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Member;
use App\User;
use GuzzleHttp\Client;
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
        $User = User::latest()->first();
        $Member = Member::create([
            'umur' => $request->umur,
            'address' => $request->address,
            'user_id' => $User->id,
            'member_id' => rand(1000, 100000),
            'phone_number' => $request->phone_number,
            'image' => $image,
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
        if ($request->image == null) {
            $image = $Member->image;
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
        $Member->update([
            'phone_number' => $request->phone_number,
            'umur' => $request->umur,
            'address' => $request->address,
            'image' => $image,
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
