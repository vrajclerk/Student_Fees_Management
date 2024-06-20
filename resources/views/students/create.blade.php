{{-- resources\views\students\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0">Add Student Record</h2>
        </div >
        <div id="error">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close btn-primary  btn-float-end" data-bs-dismiss="alert" aria-label="Close">OK</button>

    </div>
@endif
        </div>
        <div class="card-body">
            
            <form method="post" action="{{ route('students.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="roll_no" class="form-label text-success font-weight-bold ">Roll Number</label>
                    <input type="text" class="form-control" id="roll_no" name="roll_no" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label text-success font-weight-bold">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="total_fees" class="form-label text-success font-weight-bold">Total Fees</label>
                    <input type="number" class="form-control" id="total_fees" name="total_fees" step="500" required>
                </div>
                <div class="form-group mb-3">
                    <label for="fees_paid" class="form-label text-success font-weight-bold">Fees Paid</label>
                    <input type="number" class="form-control" id="fees_paid" name="fees_paid" step="500" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date" class="form-label text-success font-weight-bold">Date</label>
                    <input type="date" class="form-control col-sm-3" id="date" name="date"  required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info w-40 ">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var successMessage = document.getElementById('error');
            if (successMessage) {
                successMessage.style.transition = 'opacity 1s ease';
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 1000); // 1 second for the fade out transition
            }
        }, 5000); // 5           seconds
    });
</script>