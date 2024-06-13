@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marks for {{ $student->name }}</h2>

    <a href="{{ route('students.marks.create', $student->id) }}" class="btn btn-primary">Add Marks</a>

    <table class="table">
        <thead>
            <tr>
                <th>Roll Number</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Exam Type</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            {{-- @foreach ($student as student) --}}
            <tr>
                <td>{{ $student->roll_no }}</td>
                <td>{{ $student->name}}</td>
                
            {{-- @endforeach --}}
           
            @foreach ($marks as $mark)
                
                    <td>{{ $mark->subject }}</td>
                    <td>{{ $mark->exam_type }}</td>
                    <td>{{ $mark->marks }}</td>
                    <td>
                        <a href="{{ route('students.marks.edit', [$student->id, $mark->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('students.marks.destroy', [$student->id, $mark->id]) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this mark?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
