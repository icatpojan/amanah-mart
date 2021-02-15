<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $Supplier = Supplier::all();
        return view('pages.supplier', compact('Supplier'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'phone_number'  => 'required',
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('ada yang salah dengan data anda');
            return back();
        }
        $Supplier = Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
        try {
            $Supplier->save();
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
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('ada yang salah dengan data anda');
            return back();
        }
        $Supplier = Supplier::where('id', $id)->first();
        $Supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
        try {
            $Supplier->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        alert()->success('Success', 'Data Success dihapus');
        return back();
    }
}
