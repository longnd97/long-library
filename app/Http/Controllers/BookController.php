<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class BookController extends Controller implements BaseInterface
{
    function index()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('backend.admin.books.list', compact('books', 'categories'));
    }

    function create()
    {
        if (Gate::allows('book-crud')) {
            $categories = Category::all();
            return view('backend.admin.books.add', compact('categories'));
        } else {
            abort(403);
        }
    }

    function store(CreateBookRequest $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->desc = $request->desc;
        $book->status = BookConstant::BOOK_BORROWED;
        $book->price = $request->price;
        $book->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
            $book->image = $path;
        }
        dd($book);
        $book->save();
        Session::flash('success', 'Tạo mới sách thành công');
        return redirect()->route('books.index');
    }

    function edit($id)
    {
        if (Gate::allows('book-crud')) {
            $book = Book::findOrFail($id);
            $categories = Category::all();
            return view('backend.admin.books.update', compact('book', 'categories'));
        } else {
            abort(403);
        }
    }

    function update(UpdateBookRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $book = Book::findOrFail($id);
            $book->name = $request->name;
            $book->desc = $request->desc;
            $book->status = $request->status;
            $book->price = $request->price;
            $book->category_id = $request->category_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $book->image = $path;
            }
            $book->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        Session::flash('success', 'Cập nhật sách thành công');
        return redirect()->route('books.index');
    }

    function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json('Xóa thành công');
    }
}

