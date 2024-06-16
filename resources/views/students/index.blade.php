{{-- Index.blade.php --}}
@extends('layouts.app')

@section('content')

    <h2>Student Records</h2> 
    <form action="{{ route('students.search') }}" method="POST" class="form-inline mb-3 float-right">
        @csrf
        <input type="text" name="query" class="form-control mr-3" size="22" placeholder="Search by Roll No or Name" required>
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </form> 

    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3 float-left">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
        </svg> Student
    </a>

    @if(session('success'))
    <div class="alert alert-success" id="success-message">{{ session('success') }}</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-message').fadeOut('fast');
            }, 3000); // 5000 milliseconds = 5 seconds
        });
    </script>
    @endif

    @if($student->isEmpty())
        <p>No students found.</p>
    @else
        <table class="table table-light table-bordered">
            <thead class="table-dark">
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
            <tbody class="table-group-divider">
                @foreach ($student as $student)
                    <tr>
                        {{-- <td>{{ $student->id }}</td> --}}
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->total_fees }}</td>
                        <td>{{ $student->fees_paid }}</td>
                        <td>{{ $student->remaining_fees }}</td>
                        <td>{{ old('date', \Carbon\Carbon::parse($student->date)->format('d-m-Y')) }}</td>
                        <td class="actions">
                            <a href="{{ route('students.edit', ['id' => $student->id]) }}">
                                <button class="btn btn-primary d-inline-block m-2">Edit</button>
                            </a> | |
                            <a href="{{ route('students.force-delete', ['id' => $student->id]) }}">
                                <button type="button" class="btn btn-danger d-inline-block m-2" onclick="return confirm('Are you sure you want to move this record to trash?');">Delete</button>
                            </a> | |     
                            <a href="{{ route('students.marks.index', $student->id) }}" class="custom-tooltip" data-toggle="tooltip" title="Add and view student marks">
                                <button class="btn btn-info d-inline-block m-2">View Marks</button>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection