<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cochecitos</title>
</head>
<body>
    <h1>Lista de cochecitos</h1>
    <ol>
        @foreach($coches as $coche)
            <li>{{ $coche }}</li>
        @endforeach
    </ol>
</body>
</html>