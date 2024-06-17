@extends('lay.app')

@section('content')
<div class="container">
    <h2>Edit Marks for {{ $student->name }}</h2>

    <form action="{{ route('students.marks.update', ['student' => $student->id, 'mark' => $mark->first()->id]) }}" method="post">
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
                @foreach ($mark as $mark)
                <tr>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $mark->subject }}</td>
                    <td>
                        <input type="number" name="marks[{{ $mark->id }}][monthly_marks]" class="form-control" value="{{ $mark->monthly_marks }}">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $mark->id }}][mid_term_marks]" class="form-control" value="{{ $mark->mid_term_marks }}">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $mark->id }}][final_marks]" class="form-control" value="{{ $mark->final_marks }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-primary">Update Marks</button>
    </form>
</div>
@endsection
