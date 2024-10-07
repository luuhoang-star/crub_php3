<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
  /**
   * //LOGIC để index,thêm,sửa,xóa
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::query()->latest('id')->paginate(5);
        return view('students.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('students', $request->file('image'));
        }
        Student::create($data); // Sửa chỗ này, bỏ 1 lần gọi `create()`
        return redirect()->route('students.index')
            ->with('success', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('students', $request->file('image'));
        }

        $currentPathImage = $student->image;
        $student->update($data);

        // Sửa lỗi kiểm tra trước khi xóa ảnh cũ
        if ($request->hasFile('image') && $currentPathImage && Storage::exists($currentPathImage)) {
            Storage::delete($currentPathImage);
        }

        return back()->with('success', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        if (Storage::exists($student->image)) {
            Storage::delete($student->image);
        }
        return back()->with('success', 'Thao tác thành công');
    }
}
