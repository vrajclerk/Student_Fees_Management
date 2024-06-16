<!DOCTYPE html>
<html>
<head>
    {{-- <link rel="icon" href="asset('images/cep_logo.jpg')" /> --}}
    {{-- <img src="{{ asset('images/cep_logo.jpg') }}"  style="height: 40px; width: auto;"> --}}
    <title>CEP</title>
    <link rel="icon" type="image/x-icon" href="public/images/favicon.ico">
    <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<style>
    /* Custom tooltip style */
    .custom-tooltip + .tooltip > .tooltip-inner {
        background-color: #f0ad4e !important; /* Custom background color */
        color: #ffffff !important; /* Custom text color */
        font-size: 14px !important; /* Custom font size */
        font-weight: bold !important; /* Bold text */
        padding: 10px 15px !important; /* Padding */
        border-radius: 5px !important; /* Rounded corners */
    }
    
    .custom-tooltip + .tooltip > .tooltip-arrow {
        border-top-color: #f0ad4e !important; /* Custom arrow color */
    }
    </style>
   
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
