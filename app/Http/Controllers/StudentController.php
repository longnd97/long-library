<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    function index()
    {
        $students = Student::all();
        return view('backend.admin.students.list', compact('students'));
    }

    function create()
    {
        if (Gate::allows('student-crud')) {
            return view('backend.admin.students.add');
        } else {
            abort(403);
        }
    }

    function store(CreateStudentRequest $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->student_code = $request->student_code;
        $student->email = $request->email;
        $student->address = $request->address;
        $student->phone = $request->phone;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $path = $avatar->store('avatars', 'public');
            $student->avatar = $path;
        }
        $student->save();
        Session::flash('success', 'Thêm sinh viên thành công');
        return redirect()->route('students.index');
    }

    function edit($id)
    {
        if (Gate::allows('student-crud')) {
            $student = Student::findOrFail($id);
            return view('backend.admin.students.update', compact('student'));
        } else {
            abort(403);
        }
    }

    function update(CreateStudentRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $student = Student::findOrFail($id);
            $student->name = $request->name;
            $student->student_code = $request->student_code;
            $student->status = $request->email;
            $student->price = $request->address;
            $student->category_id = $request->phone;
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $path = $image->store('images', 'public');
                $student->image = $path;
            }
            $student->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        Session::flash('success', 'Cập nhật sách thành công');
        return redirect()->route('students.index');
    }

    function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json('Xóa thành công');
    }
}
