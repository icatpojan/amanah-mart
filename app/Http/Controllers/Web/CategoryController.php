<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\InputCategory;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->Category = new Category();
    }
    public function index()
    {
        $Category = Category::paginate(10);
        return view('pages.category', compact('Category'));
    }
    public function store(InputCategory $request)
    {
        try {
            $Category = Category::create([
                'name' => $request->name
            ]);
            $this->Category->sukses('brazil');
            return back();
        } catch (\Throwable $th) {
            $this->Category->gagal('ada yang salah');
            return back();
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $Category = Category::where('id', $id)->first();
            $Category->update([
                'name' => $request->name,
            ]);
            alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            alert()->error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
    }
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        alert()->success('Success', 'Data Success dihapus');
        return back();
    }
}
