<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="asset-url" content="{{ asset('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} - {{ getSetting('app_name') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('storage/images/'. getSetting('app_favicon')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/images/'. getSetting('app_favicon')) }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
</head>
<body>
    @include('layouts.partials.top-nav-frontend')
    @yield('content')

    {{-- footer --}}
    <footer class="page-footer bg-primary p-5 text-center text-light">
        Copyright&copy; 2022 | E - Library Apps
    </footer>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    @yield('_js')
</body>
</html>