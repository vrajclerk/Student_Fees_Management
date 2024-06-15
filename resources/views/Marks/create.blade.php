{{-- resources\views\Marks\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Marks for {{ $student->name }}</h2>

    <form action="{{ route('students.marks.store', $student->id) }}" method="post">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Monthly Marks</th>
                    <th>Mid-Term Marks</th>
                    <th>Final Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name}}</td>
                    <td>{{ $subject }}</td>
                    <td>
                        <input type="hidden" name="marks[{{ $loop->index }}][subject]" value="{{ $subject }}">
                        <input type="number" name="marks[{{ $loop->index }}][monthly_marks]" class="form-control">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $loop->index }}][mid_term_marks]" class="form-control">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $loop->index }}][final_marks]" class="form-control">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Add Marks</button>
    </form>
</div>
@endsection
