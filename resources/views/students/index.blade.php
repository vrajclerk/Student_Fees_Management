@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-primary mb-4">Student Records</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('boardmarks.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-graduation-cap"></i> Board Marks
        </a>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add Student
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <form method="GET" action="{{ route('students.index') }}" class="row g-3">
                <div class="col-md-4">
                    <select name="payment_status" id="payment_status" class="form-select">
                        <option value="">Select Fees Status</option>
                        <option value="fully_paid">Fully Paid</option>
                        <option value="partially_paid">Partially Paid</option>
                        <option value="not_paid">Not Paid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="class" id="class" class="form-select">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>{{ $class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Clear Filters</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <form action="{{ route('students.search') }}" method="POST" class="d-flex">
                @csrf
                <input type="text" name="query" class="form-control me-2" placeholder="Search by Roll No or Name" required>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($students->isEmpty())
        <div class="alert alert-info">No students found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Total Fees</th>
                        <th>Fees Paid</th>
                        <th>Remaining Fees</th>
                        <th>Date</th>
                        <th>Actions</th>
                        <th>Fees Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->roll_no }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->total_fees }}</td>
                            <td>{{ $student->fees_paid }}</td>
                            <td class="{{ $student->remaining_fees == 0 ? 'text-success' : ($student->remaining_fees == $student->total_fees ? 'text-danger' : 'text-warning') }}">
                                {{ $student->remaining_fees }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($student->date)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('students.marks.index', $student) }}" class="btn btn-sm btn-outline-success" title="Marks">
                                    <i class="fas fa-chart-bar"></i>
                                </a>
                            </td>
                            <td>
                                <span class="badge {{ $student->remaining_fees == 0 ? 'bg-success' : ($student->remaining_fees == $student->total_fees ? 'bg-danger' : 'bg-warning') }}">
                                    {{ $student->remaining_fees == 0 ? 'Fully Paid' : ($student->remaining_fees == $student->total_fees ? 'Not Paid' : 'Partially Paid') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $students->onEachSide(3)->links() }}
        </div>
    @endif
</div>
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
