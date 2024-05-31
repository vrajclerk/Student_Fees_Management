@extends('layouts.app')

@section('content')
<div class="table-container">
    <h2>Student Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Roll Number</th>
            <th>Name</th>
            <th>Total Fees</th>
            <th>Fees Paid</th>
            <th>Remaining Fees</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->roll_no }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->total_fees }}</td>
                <td>{{ $student->fees_paid }}</td>
                <td>{{ $student->remaining_fees }}</td>
                <td>{{ $student->date }}</td>
                <td class="actions">
                    <a href="{{ route('students.edit', $student->id) }}">Edit</a> | 
                    <form action="{{ route('students.destroy', $student->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
<div id="searchForm" class="form-style" style="display:none;">
    <h2>Search Student Record</h2>
    <form method="post" action="{{ route('students.search') }}">
        @csrf
        <label for="search_roll_no">Roll Number</label>
        <input type="text" id="search_roll_no" name="search_roll_no" required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
@endsection
