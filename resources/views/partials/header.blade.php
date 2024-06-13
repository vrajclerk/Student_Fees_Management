<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="img" href="#">
    <img src="{{ asset('images/cep_logo.jpg') }}" alt="Logo" class="logo" style="height: 40px; width: auto;"></a>
    <a class="navbar-brand" href="#">CLERK'S EDUCATION POINT</a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('students.index') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('students.create') }}">Add Student</a>
            </li>
            {{-- <li class="nav-item">
                <button class="btn nav-link" onclick="toggleSearchForm()">Search Student</button>
            </li> --}}
            {{-- <li class="nav-item">
                <button class="btn nav-link" onclick="toggleSearchForm()">Search Student</button>
            </li> --}}
            <li class="nav-item">
                <form method="post" action="{{ route('students.download') }}" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn nav-link">Download CSV</button>
                </form>
            </li>
            <li class="nav-item">
                <form method="post" action="{{ route('students.marks.download') }}" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn nav-link">Download Marks</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
