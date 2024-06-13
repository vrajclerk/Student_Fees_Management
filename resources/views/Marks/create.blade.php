@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Marks for {{ $student->name }}</h2>

    <form action="{{ route('students.marks.store', $student->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="subject">Subject</label>
            <select name="subject" id="subject" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject }}">{{ $subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exam_type">Exam Type</label>
            <select name="exam_type" id="exam_type" class="form-control" required>
                <option value="monthly">Monthly</option>
                <option value="mid-term">Mid-Term</option>
                <option value="final">Final</option>
            </select>
        </div>
        <div class="form-group">
            <label for="marks">Marks</label>
            <input type="number" name="marks" id="marks" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Marks</button>
    </form>
</div>
@endsection
