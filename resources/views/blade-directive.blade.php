<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @php
    $records = 0;
    @endphp

    {{-- if else statement --}}
    @if ($records === 1)
    I have one record!
    @elseif ($records > 1)
    I have multiple records!
    @else
    <h1> I don't have any records!</h1>
    @endif

    <br>
    {{-- this section is work if condition is false --}}
    @unless (false)
    You are not signed in.
    @endunless

    <br>
    {{-- check that variable must defined --}}
    @isset($arrayRecords)
    Records exists
    @endisset

    <br>
    {{-- check if value is empty --}}
    @empty($arrayRecords)
    Records are empty
    @endempty

    <br>
    @auth
    The user is authenticated...
    @endauth

    <br>
    @guest
    The user is not authenticated...
    @endguest

    <br>
    @env('local')
    The application is running in "local"...
    @endenv

    <br>
    {{-- switch case --}}
    @switch($records)
    @case(1)
    First case...
    @break

    @case(2)
    Second case...
    @break

    @default
    Default case...
    @endswitch

    <br>
    @for ($i = 0; $i < 10; $i++)
        The current value is {{ $i }} <br>
    @endfor

    <br>
    @foreach ($arrayRecords as $key => $record)
        <p>The  {{ $key }} is {{ $record }} </p> 
    @endforeach

    {{-- use this instead of foreach, if there possibility to get empty records --}}
    @forelse ($arrayRecords as $record)
        <li>{{ $record }}</li>
    @empty
        <p>No Cars</p>
    @endforelse

    @while ($records < 5)
        {{-- {{$records++}} --}}
        @php
            $records++
        @endphp
        <p>while loop index.{{$records}}</p>
    @endwhile
</body>

</html>
