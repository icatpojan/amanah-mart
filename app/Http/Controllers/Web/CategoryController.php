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
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
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
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
        alert()->success('Success', 'Data Success dihapus');
        return back();
    }
}
