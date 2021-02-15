<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $Category = Category::all();
        if ($Category == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Category bos', $Category, 200);
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'string|required',

        ]);
        $Category = Category::create([
            'name' => $request->name
        ]);
        try {
            $Category->save();
            return $this->sendResponse('Success', 'berhasil menambahkan categori', $Category, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menambahkan categori', null, 500);
        }
    }
    public function update(Request $request, $id)
    {
        $Category = Category::where('id', $id)->first();
        $Category->update([
            'name' => $request->name,
        ]);
        try {
            $Category->save();
            return $this->sendResponse('Success', 'berhasil mengupdate categori', $Category, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate categori', null, 500);
        }
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
        return $this->sendResponse('Success', 'category berhasil anda hapus bos bos', null, 200);
    }
}
