{{-- trash.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="table-container">
    <h2>Trash</h2>
    {{-- <a href="{{url('students/trash')}}">
    </a> --}}
   
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Roll Number</th>
            <th scope="col">Name</th>
            <th scope="col">Total Fees</th>
            <th scope="col">Fees Paid</th>
            <th scope="col" >Remaining Fees</th>
            <th scope="col">Date</th>
            <th scope="col" >Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($student as $student)
            @if($student)
                <tr>
                    {{-- <td>{{ $student->id }}</td> --}}
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->total_fees }}</td>
                    <td>{{ $student->fees_paid }}</td>
                    <td>{{ $student->remaining_fees }}</td>
                    <td>{{ $student->date }}</td>
                    <td class="actions">
                        <form action="{{ route('students.force-delete', ['id' => $student->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form> 
                        |
                        <form action="{{ route('students.restore', ['id' => $student->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Restore</button>
                        </form>
                    </td>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

{{-- <div id="searchForm" class="form-style" style="display:none;">
    <h2>Search Student Record</h2>
    <form method="post" action="{{ route('students.search') }}">
        @csrf
        <label for="search_roll_no">Roll Number</label>
        <input type="text" id="search_roll_no" name="search_roll_no" required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div> --}}
@endsection
