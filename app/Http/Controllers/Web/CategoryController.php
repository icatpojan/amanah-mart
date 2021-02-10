<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $Category = Category::all();
        return view('pages.category', compact('Category'));
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
}
