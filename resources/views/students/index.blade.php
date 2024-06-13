{{-- Index.blade.php --}}
@extends('layouts.app')

@section('content')
<div id="searchForm" class="form-style float-right" >
    {{-- <h2>Search Student Record</h2> --}}
    <form method="post" action="{{ route('students.search') }}">
        
        @csrf
        <label for="search_roll_no" ></label>
        <input type="text" id="search_roll_no" name="search_roll_no" placeholder="search by roll_no or name"    required>
        <button type="submit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg></button>
    </form>
</div>
<div class="table-container table-striped table-hover">
    <h2>Student Records</h2>
    
    <a href="{{ route('students.create') }}">
        <button class="btn btn-primary d-inline-block m-2 float-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
          </svg></button>
    </a>
    {{-- <a href="{{url('/students/delete/{id}')}}"> --}}
        {{-- <a href="{{ route('students.delete') }}"> --}}
        {{-- <button class="btn btn-danger d-inline-block m-2 float-right">Delete</button> --}}
    {{-- </a> --}}
    {{-- <a>
    <button class="btn btn-secondary d-inline-block m-2 float-right" onclick="toggleSearchForm()">Search </button>
    </a> --}}
    <table class="table table-light table-bordered">
        <thead class="table-dark">
        <tr>
            {{-- <th scope="col">ID</th> --}}
            <th scope="col ">Roll Number</th>
            <th scope="col">Name</th>
            <th scope="col">Total Fees</th>
            <th scope="col">Fees Paid</th>
            <th scope="col">Remaining Fees</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
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
                        <button class="btn btn-primary d-inline-block m-2 ">Edit</button>
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
