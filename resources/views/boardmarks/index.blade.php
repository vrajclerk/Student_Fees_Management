<!-- resources/views/boardmarks/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Board Marks</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Account</th>
                <th>Statistics</th>
                <th>Total</th>
                <th>Percentage</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                @foreach ($student->boardMarks as $boardMark)
                    <tr>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $boardMark->account }}</td>
                        <td>{{ $boardMark->statistics }}</td>
                        <td>{{ $boardMark->total }}</td>
                        <td>{{ $boardMark->percentage }}</td>
                        <td>{{ $boardMark->grade }}</td>
                        <td>
                            <a href="{{ route('boardmarks.edit', $boardMark->id) }}" class="btn "><svg class="svg-icon" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#a649da" stroke-linecap="round" stroke-width="2">
                                    <path d="M20 20H4"></path>
                                    <path clip-rule="evenodd" d="M14.5858 4.41422c.781-.78105 2.0474-.78105 2.8284 0 .7811.78105.7811 2.04738 0 2.82843L8.82898 15.5269l-3.03046.202.20203-3.0304z" fill-rule="evenodd"></path>
                                </g>
                            </svg></a>
                            <form action="{{ route('boardmarks.destroy', $boardMark->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                    </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('boardmarks.create') }}" class="btn btn-success">Add Board Marks</a>
</div>
@endsection
