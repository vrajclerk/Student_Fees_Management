<!-- resources/views/boardmarks/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Board Marks</h2>
    <form action="{{ route('boardmarks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="account">Account</label>
            <input type="number" name="account" id="account" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="statistics">Statistics</label>
            <input type="number" name="statistics" id="statistics" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="percentage">Percentage</label>
            <input type="text" name="percentage" id="percentage" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
