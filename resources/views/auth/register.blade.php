{{-- @extends('lay.app')
@include('partials.header') --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="img" href="/">
    <img src="{{ asset('images/cep_logo.jpg') }}" alt="Logo" class="logo" style="height: 60px; width:40px auto;"></a>
    </div>
</nav>


<x-guest-layout>
    {{-- <x-auth-card class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto mt-10"> --}}
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
            </a>
        </x-slot> --}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group mb-3">
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- Email Address -->
            <div class="form-group mb-3">
                <x-label for="email" :value="__('Email')" class="form-label text-success font-weight-bold" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required />
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- Password -->
            <div class="form-group mb-3">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password" required autocomplete="new-password" />
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- Confirm Password -->
            <div class="form-group mb-3">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password_confirmation" required />
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-4" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <x-button class="ml-4 bg-indigo-700 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        &nbsp;&nbsp;&nbsp;
        <div class="text-center container p-4">
                &nbsp;<p>&copy; 2024 CLERK'S EDUCATION POINT. All rights reserved.</p>
            </div>
        
    {{-- </x-auth-card> --}}
</x-guest-layout>


