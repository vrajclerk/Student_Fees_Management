{{-- resources\views\students\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success mb-4">Add New Student</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="roll_no" class="form-label">Roll Number</label>
                        <input type="text" class="form-control @error('roll_no') is-invalid @enderror" id="roll_no" name="roll_no" value="{{ old('roll_no') }}" required>
                        @error('roll_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="class" class="form-label">Class</label>
                        <select class="form-select @error('class') is-invalid @enderror" id="class" name="class" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $value => $label)
                                <option value="{{ $value }}" {{ old('class') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="total_fees" class="form-label">Total Fees</label>
                        <input type="number" class="form-control @error('total_fees') is-invalid @enderror" id="total_fees" name="total_fees" value="{{ old('total_fees') }}" required>
                        @error('total_fees')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="fees_paid" class="form-label">Fees Paid</label>
                        <input type="number" class="form-control @error('fees_paid') is-invalid @enderror" id="fees_paid" name="fees_paid" value="{{ old('fees_paid') }}" required>
                        @error('fees_paid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Student
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
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