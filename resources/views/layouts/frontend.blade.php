<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}} - E Library App</title>

    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
</head>
<body>
    @include('layouts.partials.top-nav-frontend')
    @yield('content')

    {{-- footer --}}
    <footer class="bg-primary p-5 text-center text-light">
        Copyright&copy; 2022 | E - Library Apps
    </footer>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    @yield('_js')
</body>
</html>