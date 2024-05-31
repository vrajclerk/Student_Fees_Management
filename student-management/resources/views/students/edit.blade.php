// resources/views/students/edit.blade.php
@extends('layouts.app')

@section('content')
<div class="form-style">
    <h2>Edit Student Record</h2>
    <form method="post" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')
        <label for="roll_no">Roll Number</label>
        <input type="text" id="roll_no" name="roll_no" value="{{ $student->roll_no }}" required>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $student->name }}" required>
        <label for="additional_fees">Additional Fees Paid</label>
        <input type="number" id="additional_fees" name="additional_fees" step="0.01" required>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="{{ $student->date }}" required>
        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>
@endsection
