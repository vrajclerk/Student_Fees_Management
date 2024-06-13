<!DOCTYPE html>
<html>
<head>
    {{-- <link rel="icon" href="asset('images/cep_logo.jpg')" /> --}}
    {{-- <img src="{{ asset('images/cep_logo.jpg') }}"  style="height: 40px; width: auto;"> --}}
    <title>CEP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>
<body>
    @include('partials.header')
    <div class="container">
        @yield('content')
    </div>
    @include('partials.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
