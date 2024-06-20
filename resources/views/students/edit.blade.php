@extends('lay.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Student Record</h2>
        </div>
        <div class="card-body">
    <form method="post" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
        <label for="roll_no" class="text-success font-italic font-weight-bold">Roll Number :</label>
        <input type="text" id="roll_no" name="roll_no" value="{{ $student->roll_no }}" required>
        </div>
        <div class="form-group mb-3">
        <label for="name" class="text-success font-italic font-weight-bold">Name :</label>
        <input type="text" id="name" name="name" value="{{ $student->name }}" required>
        </div>
        <div class="form-group mb-3">
        <label for="class" class="text-success font-italic font-weight-bold">Class :</label>
        <select name="class" id="class" required>
            <option value=""> <<<<< Select Class >>>>> </option>
            <option value="11_Morning" {{old('class', $student->class )== '11_Morning' ? 'selected' : '' }}>11th (Morning)</option>
            <option value="11_Evening" {{old('class', $student->class )== '11_Evening' ? 'selected' : '' }} >11th (Evening)</option>
            <option value="12_Morning" {{old('class', $student->class )== '12_Morning' ? 'selected' : '' }}>12th (Morning)</option>
            <option value="12_Evening" {{old('class', $student->class )== '12_Evening' ? 'selected' : '' }}>12th (Evening)</option>
        </select>
        </div>

        <div class="form-group mb-3">
        <label for="additional_fees" class="text-success font-italic font-weight-bold">Additional Fees Paid :</label>
        <input type="number" id="additional_fees" name="additional_fees" step="100" required>
        </div>
        <div class="form-group mb-3 text-success font-italic font-weight-bold">
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" value="{{ $student->date }}" required>
        </div>
        <div class="form-group text-success font-italic">
        <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>
</div>
</div>
@endsection
