<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script>
        // var app = <?php echo json_encode($car); ?>;
        var app = {{ Js::from($car) }};
        console.log(app);
    </script>
</head>

<body>
    <?php 
        $bladeVariable = 'This variable which defined in blade file.';
        echo '<i style="color:red">Italic Text</i>';
        $records = 0;
    ?>
    <br>
    {{'<i style="color:red">Italic Text</i>'}} <br>
    {!! '<i style="color:red">Italic Text</i>' !!}
    <br>
    {{ isset($userId) ? $userId : 'User Id not exits.' }}
    <h1>Home Page</h1>
    {{$defaultData}} <br>
    {{$bladeVariable}} <br>

    @if ($records === 1)
        I have one record!
    @elseif ($records > 1)
        I have multiple records!
    @else
       <h1> I don't have any records!</h1>
    @endif
</body>

</html>