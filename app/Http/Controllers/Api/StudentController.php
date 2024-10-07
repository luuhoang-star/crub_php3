<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class StudentController extends Controller
{
//full api index/store/update/destroy
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::query()->latest('id')->paginate(5);
        return response()->json($data);
    }   // hiển thị dữ liệu về api(index), destroy thì api về trắng tinh như giấy

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'code' => 'required|max:255|unique:students',
        //     'name' => 'required|max:255',
        //     'email' => 'required|max:191|unique:students',
        //     'phone' => 'required|max:255',
        //     'image' => 'required|image',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }  <!-- VALIDATE API Thêm-->
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('students', $request->file('image'));
        }
        Student::query()->create($data);
        return response()->json([], 204);
    }
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // $validator = Validator::make($request->all(), [
        //     'code' => ['required', 'max:255', Rule::unique('students')->ignore($student->id)],
        //     'name' => 'required|max:255',
        //     'email' => ['required', 'email', 'max:191', Rule::unique('students')->ignore($student->id)],
        //     'phone' => 'required|max:255',
        //     'image' => ['image', Rule::requiredIf(empty($student->image))],
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }


        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('students', $request->file('image'));
        }

        $currentPathImage = $student->image;
        $student->update($data);

        if ($request->hasFile('image') && Storage::exists($currentPathImage)) {
            Storage::delete($currentPathImage);
        }
        return response()->json($student);
        /**
         * Remove the specified resource from storage.
         */
    }
    public function destroy(Student $student)
    {
        $student->delete();
        if (Storage::exists($student->image)) {
            Storage::delete($student->image);
        }
        return response()->json([], 204);
    }
}
