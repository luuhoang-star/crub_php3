@extends('master')

@section('title')
    Danh sách Student
@endsection

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <a href="{{ route('students.create') }}" class="btn btn-primary">Thêm mới</a>

    <table class="table mt-2 mb-2">
        <tr>
            <th>ID</th>
            <th>IMAGE</th>
            <th>CODE</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>CREATED AT</th>
            <th>UPDATED AT</th>
            <th>ACTION</th>
        </tr>

        @foreach ($data as $student)
        <tr>
            <td>{{ $student->id }}</td>

            <!-- Hiển thị ảnh của sinh viên, nếu không có thì hiển thị ảnh mặc định -->
            <td>
                @if($student->image)
                    <img src="{{ Storage::url($student->image) }}" alt="Student Image" style="width:50px;">
                @else
                    <img src="{{ asset('images/default-student.jpg') }}" alt="Default Image" style="width:50px;">
                @endif
            </td>

            <td>{{ $student->code }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->created_at }}</td>
            <td>{{ $student->updated_at }}</td>
            <td>
                <a href="{{ route('students.show', $student) }}" class="btn btn-info">Show</a>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning mt-2 mb-2">Edit</a>
                <form action="{{ route('students.destroy', $student) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- Hiển thị các liên kết phân trang -->
    {{ $data->links() }}

@endsection
