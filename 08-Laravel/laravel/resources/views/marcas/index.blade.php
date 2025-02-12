<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marcas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Lista de marcas</h1>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Marca</th>
                <th>Año de fundación</th>
                <th>País</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marcas as $marca)
                <tr>
                    {{-- Gracias a lo que hemos hecho con las vistas, modelos, etc.
                    Tenemos en cada $marca las diferentes columnas que hay en la tabla, en nuestro caso
                    marca, anno_fundacion, pais. Podemos acceder directamente a ellos de esta manera --}}
                    <td>
                        <a href="{{ route('marcas.show', $marca -> id) }}">
                        {{ $marca -> marca }}
                    </td>
                    <td>{{ $marca -> anno_fundacion }}</td>
                    <td>{{ $marca -> pais }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>