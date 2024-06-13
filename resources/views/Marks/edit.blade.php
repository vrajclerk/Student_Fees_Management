@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Marks</h2>

    <form action="{{ route('students.marks.update', [$student->id, $mark->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="roll_no">Roll Number</label>
        <input type="text" id="roll_no" name="roll_no" value="{{ $student->roll_no }}" required>
        
        
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $student->name }}" required>
       
            <label for="subject">Subject</label>
            <select name="subject" id="subject" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject }}" {{ $subject == $mark->subject ? 'selected' : '' }}>
                        {{ $subject }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exam_type">Exam Type</label>
            <select name="exam_type" id="exam_type" class="form-control" required>
                <option value="monthly" {{ $mark->exam_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="mid-term" {{ $mark->exam_type == 'mid-term' ? 'selected' : '' }}>Mid-Term</option>
                <option value="final" {{ $mark->exam_type == 'final' ? 'selected' : '' }}>Final</option>
            </select>
        </div>
        <div class="form-group">
            <label for="marks">Marks</label>
            <input type="number" name="marks" id="marks" class="form-control" value="{{ $mark->marks }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Marks</button>
    </form>
</div>
@endsection
