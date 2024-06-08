@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Student Record</h2>
        </div>
        <div class="card-body">
    <form method="post" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
        <label for="roll_no">Roll Number</label>
        <input type="text" id="roll_no" name="roll_no" value="{{ $student->roll_no }}" required>
        </div>
        <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $student->name }}" required>
        </div>
        <div class="form-group mb-3">
        <label for="additional_fees">Additional Fees Paid</label>
        <input type="number" id="additional_fees" name="additional_fees" step="0.01" required>
        </div>
        <div class="form-group mb-3">
        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="{{ $student->date }}" required>
        </div>
        <div class="form-group ">
        <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>
</div>
</div>
@endsection
