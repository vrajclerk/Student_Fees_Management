<!-- resources/views/boardmarks/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Board Marks</h2>
    <form action="{{ route('boardmarks.update', $boardmark->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $boardmark->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="account">Account</label>
            <input type="number" name="account" id="account" class="form-control" value="{{ $boardmark->account }}" required>
        </div>
        <div class="form-group">
            <label for="statistics">Statistics</label>
            <input type="number" name="statistics" id="statistics" class="form-control" value="{{ $boardmark->statistics }}" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ $boardmark->total }}" required>
        </div>
        <div class="form-group">
            <label for="percentage">Percentage</label>
            <input type="text" name="percentage" id="percentage" class="form-control" value="{{ $boardmark->percentage }}" required>
        </div>
        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control" value="{{ $boardmark->grade }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
