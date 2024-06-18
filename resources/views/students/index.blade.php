{{-- Index.blade.php --}}
@extends('layouts.app')

@section('content')

    <h2 class="font-monospace fw-semibold ">Student Records</h2> 
    <div>
        <form method="GET" action="{{ route('students.index') }}" class="float-center">
    
            <div class="form-group ">
                {{-- <label for="payment_status">Filter by Fees Status</label> --}}
                <select name="payment_status" id="payment_status" class="$form-select-feedback-icon-size:        $input-height-inner-half $input-height-inner-half; ">
                    <option value=""> Select Fees Status </option>
                    <option value="fully_paid">Fully Paid</option>
                    <option value="partially_paid">Partially Paid</option>
                    <option value="not_paid">Not Paid</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
           
        </form>
    </div>
   
<div>
    <form action="{{ route('students.search') }}" method="POST" class="form-inline mb-3 float-right">
        @csrf
        <input type="text" name="query" class="form-control mr-3" size="22" placeholder="Search by Roll No or Name" required>
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </form> 
</div>

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

    @if($students->isEmpty())
        <p>No students found.</p>
    @else
        <table class="table  table-bordered table-striped-columns table-hover bg-dark.bg-gradient" style="width:100%">
            <thead class="table-dark">
                <tr class="text-center">
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col" style="width:5%">Roll Number</th>
                    <th scope="col" style="width:15%">Name</th>
                    <th scope="col">Total Fees</th>
                    <th scope="col">Fees Paid</th>
                    <th scope="col"style="width:10%">Remaining Fees</th>

                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                    <th scope="col" style="width:5%"> Fees Status</th>
                </tr>
            </thead>
            <tbody  id="studentTableBody" class="table-group-divider ">
                @foreach ($students as $student)
                <tr class="text-center">
                        {{-- <td>{{ $student->id }}</td> --}}
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->total_fees }}</td>
                        <td>{{ $student->fees_paid }}</td>
                        
                        <td>{{ $student->remaining_fees }}</td>
                        
                        <td>{{ old('date', \Carbon\Carbon::parse($student->date)->format('d-m-Y')) }}</td>
                        <td class="actions">
                            <a href="{{ route('students.edit', ['id' => $student->id]) }}">
                                <button class="btn btn-light d-inline-block m-2"><svg class="svg-icon" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g stroke="#a649da" stroke-linecap="round" stroke-width="2"><path d="m20 20h-16"></path><path clip-rule="evenodd" d="m14.5858 4.41422c.781-.78105 2.0474-.78105 2.8284 0 .7811.78105.7811 2.04738 0 2.82843l-8.28322 8.28325-3.03046.202.20203-3.0304z" fill-rule="evenodd"></path></g></svg></button>
                            </a> | |
                            <a href="{{ route('students.force-delete', ['id' => $student->id]) }}">
                                <button type="button" class="btn btn-danger  d-inline-block m-2" onclick="return confirm('Are you sure you want to move this record to trash?');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                  </svg></button>
                            </a> | |     
                            <a href="{{ route('students.marks.index', $student->id) }}" class="custom-tooltip" data-toggle="tooltip" title="Add and view student marks">
                                <button class="btn btn-info d-inline-block m-2">View Marks</button>
                            </a>

                        </td>
                        <td>{{ $student->payment_status }}</td>

                        {{-- @if( $student->total_fees==$student->fees_paid)
                        <td>{{"Fully Paid"}} </td>

                        @elseif($student->total_fees>$student->fees_paid)
                        <td>{{"Partially Paid"}} </td>

                        @elseif( $student->total_fees==$student->remaining_fees)
                        <td>{{"Not Paid"}} </td>
                       
                        @endif --}}
                    </tr>
                @endforeach
                
            </tbody>
            
        </table>
        <div id="paginationLinks">
            {{ $students->links() }}
        </div>
    @endif
    
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function fetchStudents(page = 1) {
        var paymentStatus = $('#payment_status').val();
        $.ajax({
            url: '{{ route("students.index") }}',
            type: 'GET',
            data: { payment_status: paymentStatus, page: page },
            success: function(response) {
                var tbody = $('#studentTableBody');
                tbody.empty();
                $.each(response.students.data, function(index, student) {
                    var row = '<tr>' +
                        '<td>' + student.roll_no + '</td>' +
                        '<td>' + student.name + '</td>' +
                        '<td>' + student.total_fees + '</td>' +
                        '<td>' + student.fees_paid + '</td>' +
                        '<td>' + student.remaining_fees + '</td>' +
                        '<td>' + student.payment_status + '</td>' +
                        '</tr>';
                    tbody.append(row);
                });

                // Update pagination links
                $('#paginationLinks').html(response.pagination);
            }
        });
    }

    $('#payment_status').change(function() {
        fetchStudents();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchStudents(page);
    });
});
</script>
@endsection