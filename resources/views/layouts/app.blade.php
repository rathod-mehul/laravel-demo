<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <title>@yield('title')</title>
    <style>
        .active {
            text-decoration: none;
            color: green;
        }
    </style>
</head>

<body>
    {{-- <nav>
        <a href="{{ url('/') }}">Home</a>
    <a href="{{ url('/page-1') }}">Page 1</a>
    <a href="{{ url('/page-2') }}">Page 2</a>
    <a href="{{ url('/page-3') }}">Page 3</a>
    </nav>
    <h1>Sidebar</h1>
    <div>
        This is main page
    </div>
    <h1>Footer</h1> --}}
    @sectionMissing('content')
        <div class="text-danger">Default Content</div>
    @endif
    @includeIf('layouts.navbar')
    {{-- @include('layouts.navbar1') --}}
    @include('layouts.sidebar')
    @yield('content')
    @include('layouts.footer')
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
