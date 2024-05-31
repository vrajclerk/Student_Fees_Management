<!DOCTYPE html>
<html>
<head>
    <title>Student Fee Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <div class="banner">
            <h1>CLERK'S EDUCATION POINT</h1>
            <img src="{{ asset('images/file.png') }}" alt="Logo" class="logo">
            <h1>Student Fee Management</h1>
        </div>
    </header>
    <div class="header-buttons">
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
        <button onclick="toggleSearchForm()">Search Student</button>
        <form method="post" action="{{ route('students.download') }}" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-secondary">Download CSV</button>
        </form>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <script>
        function toggleSearchForm() {
            var searchForm = document.getElementById('searchForm');
            if (searchForm.style.display === 'none' || searchForm.style.display === '') {
                searchForm.style.display = 'block';
            } else {
                searchForm.style.display = 'none';
            }
        }
    </script>
</body>
</html>
