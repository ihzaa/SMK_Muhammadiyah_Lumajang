<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="@yield('meta_description')">
    <meta name="author" content="{{ env('APP_NAME') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <title>@yield('meta_title') | {{ env('APP_NAME') }}</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/font-awesome.css" />
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/style.css">

    @stack('styles')

    <style>
        img {
            max-width: 100% !important;
        }

    </style>
</head>

<body>
    <div class="container-fluid p-0 home">

        @include('front-user.layouts.partials.navbar')

    </div>

    @yield('content')

    @include('front-user.layouts.partials.footer')

    <!-- jQuery -->
    <script src="{{ asset('front-user') }}/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('front-user') }}/js/bootstrap.min.js"></script>

    @stack('scripts')
</body>

</html>
