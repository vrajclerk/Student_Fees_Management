@extends('lay.app')

@section('content')
<div class="container">
    <h2>Edit Marks for {{ $student->name }}</h2>

    <form action="{{ route('students.marks.update', ['student' => $student->id, 'mark' => $marks->first()->id]) }}" method="post">
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
                @foreach ($marks as $singleMark)
                <tr>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $singleMark->subject }}</td>
                    <td>
                        <input type="number" name="marks[{{ $singleMark->id }}][monthly_marks]" class="form-control" value="{{ $singleMark->monthly_marks }}">
                        <input type="hidden" name="marks[{{ $singleMark->id }}][id]" value="{{ $singleMark->id }}">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $singleMark->id }}][mid_term_marks]" class="form-control" value="{{ $singleMark->mid_term_marks }}">
                    </td>
                    <td>
                        <input type="number" name="marks[{{ $singleMark->id }}][final_marks]" class="form-control" value="{{ $singleMark->final_marks }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update Marks</button>
    </form>
</div>
@endsection
