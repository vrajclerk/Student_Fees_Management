@extends('layouts.app')

@section('content')

    <h2 class="font-monospace font-weight-bold" style="color:rgb(6, 138, 17)">Student Records</h2> 
    <div>
        <form method="GET" action="{{ route('students.index') }}" class="float-center" id="filterform">
            <div class="form-group">
                <select name="payment_status" id="payment_status" class="$form-select-feedback-icon-size:$input-height-inner-half $input-height-inner-half;">
                    <option value="">Select Fees Status</option>
                    <option value="fully_paid">Fully Paid</option>
                    <option value="partially_paid">Partially Paid</option>
                    <option value="not_paid">Not Paid</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
                    </svg>
                </button>
            {{-- </div> --}}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{-- <div class="form-group"> --}}
                <select name="class" id="class" class="$form-select-feedback-icon-size:$input-height-inner-half $input-height-inner-half;">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>{{ $class }}</option>
                    @endforeach
                </select>
            
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
                </svg>
            </button>
        </form>
    </div>
    {{-- </div> --}}

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

    @if (session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-primary btn-float-end" data-bs-dismiss="alert" aria-label="Close">OK</button>
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
                        }, 1000);
                    }
                }, 5000);
            });
        </script>
    @endif

    @if($students->isEmpty())
        <p>No students found.</p>
    @else
        <table class="table table-bordered table-striped table-hover bg-dark.bg-gradient" style="width:100%">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" style="width:5%">Roll Number</th>
                    <th scope="col" style="width:10%">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Total Fees</th>
                    <th scope="col">Fees Paid</th>
                    <th scope="col" style="width:5%">Remaining Fees</th>
                    <th scope="col">Date</th>
                    <th scope="col" style="width:25%">Actions</th>
                    <th scope="col" style="width:5%">Fees Status</th>
                </tr>
            </thead>
            <tbody id="studentTableBody" class="table-group-divider">
                @foreach ($students as $student)
                    <tr class="text-center">
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->total_fees }}</td>
                        <td>{{ $student->fees_paid }}</td>
                        <td style="background-color: 
                            @if ($student->fees_paid == 0)
                                red
                            @elseif ($student->fees_paid == $student->total_fees)
                                rgb(113, 202, 78)
                            @else
                                orange
                            @endif">
                            {{ $student->remaining_fees }}
                        </td>
                        <td>{{ old('date', \Carbon\Carbon::parse($student->date)->format('d-m-Y')) }}</td>
                        <td class="actions">
                            <a href="{{ route('students.edit', ['id' => $student->id]) }}">
                                <button class="btn btn-light d-inline-block m-2">
                                    <svg class="svg-icon" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <g stroke="#a649da" stroke-linecap="round" stroke-width="2">
                                            <path d="M20 20H4"></path>
                                            <path clip-rule="evenodd" d="M14.5858 4.41422c.781-.78105 2.0474-.78105 2.8284 0 .7811.78105.7811 2.04738 0 2.82843L8.82898 15.5269l-3.03046.202.20203-3.0304z" fill-rule="evenodd"></path>
                                        </g>
                                    </svg>
                                </button>
                            </a> 
                            | 
                            <a href="{{ route('students.force-delete', ['id' => $student->id]) }}">
                                <button type="button" class="btn btn-danger d-inline-block m-2" onclick="return confirm('Are you sure you want to delete this record?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </a> 
                            | 
                            <a href="{{ route('students.marks.index', $student->id) }}" class="custom-tooltip" data-toggle="tooltip" title="Add and view student marks">
                                <button class="btn d-inline-block m-2" style="background-color:rgb(113, 202, 78)">Marks</button>
                            </a>
                        </td>
                        <td style="font-weight: bold">
                            @php
                                $remainingFees = $student->remaining_fees;
                                $totalFees = $student->total_fees;
                                $feesStatusColor = '';

                                if ($remainingFees == 0) {
                                    $feesStatusColor = 'green';
                                } elseif ($remainingFees == $totalFees) {
                                    $feesStatusColor = 'red';
                                } else {
                                    $feesStatusColor = 'orange';
                                }
                            @endphp
                            <span style="color: {{ $feesStatusColor }}">
                                {{ $student->payment_status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="row">
            {{ $students->onEachSide(3)->links() }}
        </div>
    @endif

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

$(document).ready(function() {
    $('#payment_status').change(function() {
        $('#filterform').submit();
    });
});

$(document).ready(function() {
    $('#class').change(function() {
        $('#filterform').submit();
    });
});
</script>
@endsection
