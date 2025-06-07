@extends('layouts.app')

@section('guest')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 fade-in">
            <h1 class="display-4 fw-bold text-success mb-4">Student Fees Management System</h1>
            <p class="lead mb-4">Streamline your educational institution's fee management with our comprehensive solution. Track payments, manage student records, and monitor academic performance all in one place.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </a>
                @else
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                        <i class="fas fa-users me-2"></i> View Students
                    </a>
                @endguest
            </div>
        </div>
        <div class="col-md-6 fade-in">
            <img src="{{ asset('images/education.svg') }}" alt="Education Illustration" class="img-fluid">
        </div>
    </div>

    <div class="row mt-5 pt-5">
        <div class="col-12 text-center mb-5">
            <h2 class="text-success">Key Features</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-money-bill-wave fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Fee Management</h5>
                    <p class="card-text">Easily track and manage student fees, payments, and outstanding balances.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Performance Tracking</h5>
                    <p class="card-text">Monitor student academic performance with detailed grade tracking.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-file-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Report Generation</h5>
                    <p class="card-text">Generate comprehensive reports for fees, attendance, and academic progress.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5">
        <div class="col-12 text-center mb-5">
            <h2 class="text-success">Why Choose Us?</h2>
        </div>
        <div class="col-md-6 mb-4">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                </div>
                <div>
                    <h5>User-Friendly Interface</h5>
                    <p>Intuitive design makes it easy to navigate and use all features.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                </div>
                <div>
                    <h5>Secure Data Management</h5>
                    <p>Your data is protected with advanced security measures.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                </div>
                <div>
                    <h5>Real-time Updates</h5>
                    <p>Get instant updates on fees, grades, and student information.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                </div>
                <div>
                    <h5>24/7 Support</h5>
                    <p>Round-the-clock support to help you with any issues.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
