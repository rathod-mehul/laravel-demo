<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Email</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/argon-dashboard.css?v=2.1.0') }}">
</head>

<body>
    <h1 class="text-primary">Name: {{ $user->name ?? 'Demo' }}</h1>
    <h2 class="text-secondary">Email: {{ $user->email ?? 'Demo' }}</h2>
</body>

</html>
