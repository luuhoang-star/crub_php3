@extends('master')

@section('title')
    Chi tiết Student:
@endsection

@section('content')
    <table class="table">
        <tr>
            <th>Trường</th>
            <th>Value</th>
        </tr>
        @foreach ($student->toArray() as $field => $value)
            <tr>
                <td>{{ $field }}</td>
                <td>
                    @php
                        switch ($field) {
                            case 'image':
                                $url = Storage::url($student->image); // Thêm dấu chấm phẩy
                                echo "<img src=\"$url\" width=\"50px\" alt=\"\">"; // Sửa lại biến $url
                                break;
                            default:
                                echo ($value); // Sử dụng echo với escaping
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('students.index') }}" class="btn btn-danger">Back to list</a>
@endsection
