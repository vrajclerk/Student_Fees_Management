@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Marks for {{ $student->name }}</h2>

    <form action="{{ route('students.marks.update', [$student->id, $mark->id]) }}" method="post">
        @csrf
        @method('PUT')
        <table class="table">
            <thead>
                <tr>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Monthly Marks</th>
                    <th>Mid-Term Marks</th>
                    <th>Final Marks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name}}</td>
                @foreach ($mark as $mark)
                <tr>
                    <td>{{ $mark->subjects }}</td>
                    <td>
                        <input type="hidden" name="marks[{{ $loop->index }}][id]" value="{{ $mark->id }}">
                        <input type="number" name="marks[{{ $loop->index }}][monthly_marks]" class="form-control" value="{{ $mark->monthly_marks }}">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $loop->index }}][mid_term_marks]" class="form-control" value="{{ $mark->mid_term_marks }}">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $loop->index }}][final_marks]" class="form-control" value="{{ $mark->final_marks }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update Marks</button>
    </form>
</div>
@endsection