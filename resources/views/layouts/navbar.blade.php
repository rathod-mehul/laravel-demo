<nav>
    <a href="{{ url('/') }}" @class(['active' => request()->is('/')])>Page 1</a>
    {{-- <a href="{{ url('/page-1') }}">Page 1</a> --}}
    <a href="{{ url('/page-2') }}"  @class(['active' => request()->is('page-2')])>Page 2</a>
    <a href="{{ url('/page-3') }}"  @class(['active' => request()->is('page-3')])>Page 3</a>
    <a href="{{ url('/form') }}"  @class(['active' => request()->is('form')])>Form</a>
</nav>