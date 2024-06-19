@extends('lay.app')

@section('content')
<div class="container">
    <h2 style="color:darkblue">
        Marks for <span style="color: green;">{{ $student->name }}</span> ,&nbsp;&nbsp;&nbsp;
        Roll-Number: <span style="color: green;">{{ $student->roll_no }}</span>
    </h2>
    
    

    <a href="{{ route('students.marks.create', $student->id) }}" class="btn btn-primary">Add Marks</a>
    @if (session('success'))
    <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
       
        <button type="button" class="btn-close btn-danger float-end" data-bs-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg></button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.transition = 'opacity 1s ease';
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 1000); // 1 second for the fade out transition
                }
            }, 4000); // 4 seconds
        });
    </script>
    @endif
    
    <table class="table  table-bordered table-striped-columns table-hover">
        <thead class="table-dark">
            <tr class="text-center">
                {{-- <th >Roll Number</th> --}}
                {{-- <th style="width:15%">Name</th> --}}
                <th >Subject</th>
                <th >Monthly Marks</th>
                <th >Mid-Term Marks</th>
                <th >Final Marks</th>
                <th >Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($marks as $mark)
            <tr class="text-center">
                {{-- <td>{{ $student->roll_no }}</td> --}}
                {{-- <td>{{ $student->name }}</td> --}}
                <td>{{ $mark->subject }}</td>
                <td>{{ $mark->monthly_marks }}</td>
                <td>{{ $mark->mid_term_marks }}</td>
                <td>{{ $mark->final_marks }}</td>
                <td>
                    <a href="{{ route('students.marks.edit', [$student->id, $mark->id]) }}" class="btn btn-light"><svg class="svg-icon" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g stroke="#a649da" stroke-linecap="round" stroke-width="2"><path d="m20 20h-16"></path><path clip-rule="evenodd" d="m14.5858 4.41422c.781-.78105 2.0474-.78105 2.8284 0 .7811.78105.7811 2.04738 0 2.82843l-8.28322 8.28325-3.03046.202.20203-3.0304z" fill-rule="evenodd"></path></g></svg></a> | |
                    <form action="{{ route('students.marks.destroy', [$student->id, $mark->id]) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this mark?');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                          </svg></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
