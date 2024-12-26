<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
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

    @include('layouts.navbar')
    @include('layouts.sidebar')
    @yield('content')
    @include('layouts.footer')
</body>
</html>
