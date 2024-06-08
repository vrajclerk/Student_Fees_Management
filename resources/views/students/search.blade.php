@extends('layouts.app')

@section('content')
<div id="searchForm" class="form-style" style="display:none;">
    <h2>Search Student Record</h2>
    <form method="post" action="{{ route('students.search') }}">
        @csrf
        <label for="search_roll_no">Roll Number</label>
        <input type="text" id="search_roll_no" name="search_roll_no" required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
@endsection