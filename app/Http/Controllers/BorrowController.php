<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class BorrowController extends Controller
{
    function index()
    {
        $borrows = Borrow::all();
        return view('backend.admin.borrows.list', compact('borrows'));
    }

    function create()
    {
        $books = Book::all();
        return view('backend.admin.borrows.add', compact('books'));
    }

    function searchStudent(Request $request)
    {
        $keyword = $request->keyword;
        $students = Student::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('student_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return response()->json($students);
    }

    function findStudent($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    function searchBook(Request $request)
    {
        $keyword = $request->keyword;
        $books = Book::where('name', 'LIKE', '%' . $keyword . '%')->get();
        return response()->json($books);
    }

    function findBook($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($this->checkStatusBook($request->book_status) && $request->borrow_date < $request->return_date) {
                $borrow = new Borrow();
                $borrow->student_id = $request->student_id;
                $borrow->borrow_date = $request->borrow_date;
                $borrow->return_date = $request->return_date;
                $borrow->status = BorrowConstant::BORROWED;
                $borrow->save();
                $borrow->books()->sync($request->book_id);
                $borrow->books()->update(['status' => BookConstant::BOOK_NOT_BORROWED]);
                DB::commit();
                return response()->json('Cho mượn thành công');
            } else if ($request->borrow_date >= $request->return_date) {
                return response()->json('Ngày mượn phải trước ngày trả');
            } else {
                return response()->json('Sách chưa thể mượn!! Vui lòng chọn sách khác');
            }

        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage());
        }

    }

    function indexReturn()
    {
        $borrows = Borrow::all();
        return view('backend.admin.borrows.list-return', compact('borrows'));
    }

    function confirmReturn($id)
    {
        $borrow = Borrow::find($id);
        $borrow->books()->update(['status' => BookConstant::BOOK_BORROWED]);
        $borrow->status = BorrowConstant::BORROW_RETURN;
        $borrow->save();
        return response()->json('Xác nhận thành công');
    }

    function checkStatusBook($status)
    {
        if ($status == BookConstant::BOOK_BORROWED) {
            return true;
        }
        return false;
    }
}
