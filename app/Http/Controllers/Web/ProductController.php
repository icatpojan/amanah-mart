<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $Category = Category::all();
        $Product = Product::all();
        $Supplier = Supplier::all();
        return view('pages.product', compact('Product', 'Category', 'Supplier'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'barcode' => 'integer|required|unique:products',
            'category_id' => 'integer|required',
            'supplier_id' => 'integer|required',
            'merek' => 'string|required',
        ]);
        if ($validator->fails()) {
            return back()->withToastError($validator->messages()->all()[0])->withInput();
        }
        $Product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'barcode' => $request->barcode,
            'supplier_id' => $request->supplier_id,
            'merek' => $request->merek,
            'diskon' => $request->diskon,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->diskon_jual,
        ]);

        try {
            $Product->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function update(Request $request, $id)
    {
        $Product = Product::where('id', $id)->first();
        $Product->update([
            'name' => $request->name == null ? $Product->name : $request->name,
            'merek' => $request->merek == null ? $Product->merek : $request->merek,
            'stock' => $request->stock == null ? $Product->stock : $request->stock,
            'harga_beli' => $request->harga_beli == null ? $Product->harga_beli : $request->harga_beli,
            'harga_jual' => $request->harga_jual == null ? $Product->harga_jual : $request->harga_jual,
            'diskon' => $request->diskon == null ? $Product->diskon : $request->diskon,
        ]);
        try {
            $Product->save();
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
}
