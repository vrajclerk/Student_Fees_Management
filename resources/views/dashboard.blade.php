@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h5 class="card-title mb-3">Welcome!</h5>
                    <p class="card-text">You're logged in!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
