@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success mb-4">Student Marks</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('students.index') }}" class="btn btn-outline-success">
            <i class="fas fa-arrow-left"></i> Back to Students
        </a>
        <a href="{{ route('students.marks.create', $student->id) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Marks
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Student Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Roll Number:</strong> {{ $student->roll_no }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Class:</strong> {{ $student->class }}</p>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($marks->isEmpty())
        <div class="alert alert-info">No marks found for this student.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Total Marks</th>
                        <th>Percentage</th>
                        <th>Grade</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marks as $mark)
                        <tr>
                            <td>{{ $mark->subject }}</td>
                            <td>{{ $mark->marks }}</td>
                            <td>{{ $mark->total_marks }}</td>
                            <td>{{ $mark->percentage }}%</td>
                            <td>{{ $mark->grade }}</td>
                            <td>{{ \Carbon\Carbon::parse($mark->date)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('students.marks.edit', [$student->id, $mark->id]) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('students.marks.delete', [$student->id, $mark->id]) }}" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $marks->onEachSide(3)->links() }}
        </div>
    @endif
</div>
@endsection
