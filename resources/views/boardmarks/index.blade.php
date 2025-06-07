<!-- resources/views/boardmarks/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success mb-4">Board Marks</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('students.index') }}" class="btn btn-outline-success">
            <i class="fas fa-arrow-left"></i> Back to Students
        </a>
        <a href="{{ route('boardmarks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Board Marks
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <form method="GET" action="{{ route('boardmarks.index') }}" class="row g-3">
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
                    <a href="{{ route('boardmarks.index') }}" class="btn btn-outline-secondary">Clear Filters</a>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($boardmarks->isEmpty())
        <div class="alert alert-info">No board marks found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>English</th>
                        <th>Hindi</th>
                        <th>Maths</th>
                        <th>Science</th>
                        <th>Social Science</th>
                        <th>Total Marks</th>
                        <th>Percentage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boardmarks as $mark)
                        <tr>
                            <td>{{ $mark->roll_no }}</td>
                            <td>{{ $mark->name }}</td>
                            <td>{{ $mark->class }}</td>
                            <td>{{ $mark->english }}</td>
                            <td>{{ $mark->hindi }}</td>
                            <td>{{ $mark->maths }}</td>
                            <td>{{ $mark->science }}</td>
                            <td>{{ $mark->social_science }}</td>
                            <td>{{ $mark->total_marks }}</td>
                            <td>{{ $mark->percentage }}%</td>
                            <td>
                                <a href="{{ route('boardmarks.edit', $mark->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('boardmarks.delete', $mark->id) }}" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $boardmarks->onEachSide(3)->links() }}
        </div>
    @endif
</div>
@endsection
