<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $Supplier = Supplier::all();
        return $this->sendResponse('Success', 'ini dia daftar Supplier  bos', $Supplier, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'phone_number'  => 'required',
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Supplier = Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
        return $this->sendResponse('Success', 'ini dia supplier  bos', $Supplier, 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'phone_number'  => 'required',
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Supplier = Supplier::where('id', $id)->first();
        $Supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
        return $this->sendResponse('Success', 'berhasil update supplier  bos', $Supplier, 200);
    }
    public function destroy($id)
    {
        $Supplier = Supplier::find($id)->delete();
        return $this->sendResponse('Success', 'berhasil hapus supplier  bos', $Supplier, 200);
    }
}
