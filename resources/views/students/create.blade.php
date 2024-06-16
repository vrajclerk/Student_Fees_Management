{{-- resources\views\students\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0">Add Student Record</h2>
        </div>
        <div class="card-body">
            
            <form method="post" action="{{ route('students.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="roll_no" class="form-label text-success font-weight-bold" >Roll Number</label>
                    <input type="text" class="form-control" id="roll_no" name="roll_no" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label text-success font-weight-bold">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="total_fees" class="form-label text-success font-weight-bold">Total Fees</label>
                    <input type="number" class="form-control" id="total_fees" name="total_fees" step="0.01" required>
                </div>
                <div class="form-group mb-3">
                    <label for="fees_paid" class="form-label text-success font-weight-bold">Fees Paid</label>
                    <input type="number" class="form-control" id="fees_paid" name="fees_paid" step="0.01" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date" class="form-label text-success font-weight-bold">Date</label>
                    <input type="date" class="form-control" id="date" name="date"  required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info w-100">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
