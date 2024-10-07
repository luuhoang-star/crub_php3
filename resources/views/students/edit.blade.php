@extends('master')

@section('title')
    Cập nhật Student: {{ $student->name }}
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 mt-3">  <!-- Sửa class đây -->
            <label for="code" class="form-label">Code:</label>
            <input type="text" class="form-control" id="code" value="{{ old('code', $student->code) }}" placeholder="Enter code" name="code">
        </div>

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ old('name', $student->name) }}" placeholder="Enter name" name="name">
        </div>

        <div class="mb-3 mt-3">  <!-- Sửa class ở đây -->
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ old('email', $student->email) }}" placeholder="Enter email" name="email">
        </div>

        <div class="mb-3 mt-3">  <!-- Sửa class ở đây -->
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" id="phone" value="{{ old('phone', $student->phone) }}" placeholder="Enter phone" name="phone">
        </div>

        <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">

            <img src="{{ Storage::url($student->image) }}" alt="Student Image" style="width:50px;">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('students.index') }}" class="btn btn-danger">Back to list</a>
    </form>
@endsection
