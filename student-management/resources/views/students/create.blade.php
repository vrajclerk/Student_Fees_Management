// resources/views/students/create.blade.php
@extends('layouts.app')

@section('content')
<div class="form-style">
    <h2>Add Student Record</h2>
    <form method="post" action="{{ route('students.store') }}">
        @csrf
        <label for="roll_no">Roll Number</label>
        <input type="text" id="roll_no" name="roll_no" required>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        <label for="total_fees">Total Fees</label>
        <input type="number" id="total_fees" name="total_fees" step="0.01" required>
        <label for="fees_paid">Fees Paid</label>
        <input type="number" id="fees_paid" name="fees_paid" step="0.01" required>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" required>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>
@endsection
