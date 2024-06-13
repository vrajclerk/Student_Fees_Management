{{-- Index.blade.php --}}
@extends('layouts.app')

@section('content')
<div id="searchForm" class="form-style float-right" >
    {{-- <h2>Search Student Record</h2> --}}
    <form method="post" action="{{ route('students.search') }}">
        @csrf
        <label for="search_roll_no" ></label>
        <input type="text" id="search_roll_no" name="search_roll_no" required>
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>
</div>
<div class="table-container">
    <h2>Student Records</h2>
    
    <a href="{{ route('students.create') }}">
        <button class="btn btn-primary d-inline-block m-2 float-right">Add</button>
    </a>
    {{-- <a href="{{url('/students/delete/{id}')}}"> --}}
        {{-- <a href="{{ route('students.delete') }}"> --}}
        {{-- <button class="btn btn-danger d-inline-block m-2 float-right">Delete</button> --}}
    {{-- </a> --}}
    {{-- <a>
    <button class="btn btn-secondary d-inline-block m-2 float-right" onclick="toggleSearchForm()">Search </button>
    </a> --}}
    <table class="table">
        <thead>
        <tr>
            {{-- <th scope="col">ID</th> --}}
            <th scope="col">Roll Number</th>
            <th scope="col">Name</th>
            <th scope="col">Total Fees</th>
            <th scope="col">Fees Paid</th>
            <th scope="col">Remaining Fees</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($student as $student)
            <tr>
                {{-- <td>{{ $student->id }}</td> --}}
                <td>{{ $student->roll_no }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->total_fees }}</td>
                <td>{{ $student->fees_paid }}</td>
                <td>{{ $student->remaining_fees }}</td>
                <td> {{ old('date', \Carbon\Carbon::parse($student->date)->format('d-m-Y')) }}</td>
                {{-- <td>{{$student->date}}</td> --}}
                <td class="actions">
                    <a href="{{ route('students.edit', ['id' => $student->id]) }}">
                        <button class="btn btn-primary d-inline-block m-2">Edit</button>
                    </a> | 
                    <a href="{{ route('students.force-delete', ['id' => $student->id]) }}">
                        <button type="button" class="btn-danger d-inline-block m-2" onclick="return confirm('Are you sure you want to move this record to trash?');">Delete</button>
                    </a>  |
                    <a href="{{ route('students.marks.index', $student->id) }}" >
                        <button class="btn btn-info d-inline-block m-2">View Marks</button>
                    </a>
                </td>
            </tr>
           
        @endforeach
        </tbody>
    </table>
</div>


@endsection
