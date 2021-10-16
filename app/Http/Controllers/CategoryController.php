<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller implements BaseInterface
{
    function index()
    {
        if (Gate::allows('category-crud')) {
            $categories = Category::all();
            return view('backend.admin.categories.list', compact('categories'));
        } else {
            abort(403);
        }
    }

    function create()
    {
        if (Gate::allows('category-crud')) {
            return view('backend.admin.categories.add');
        } else {
            abort(403);
        }
    }

    function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        Session::flash('success', 'Tạo mới thể loại thành công');
        return redirect()->route('categories.index');
    }

    function edit($id)
    {
        if (Gate::allows('category-crud')) {
            $category = Category::findOrFail($id);
            return view('backend.admin.categories.update', compact('category'));
        } else {
            abort(403);
        }
    }

    function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        Session::flash('success', 'Cập nhật thể loại thành công');
        return redirect()->route('categories.index');
    }

    function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('success', 'Xóa thể loại thành công');
        return redirect()->route('categories.index');
    }
}
