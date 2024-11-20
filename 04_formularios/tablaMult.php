<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de multiplicar</title>
</head>
<body>
    <!-- 
    CREAR UN FORMULARIO QUE RECIBA UN NÚMERO 
    SE MOSTRARÁ LA TABLA DE MULTIPLICAR DE ESE NÚMERO EN UNA TABLA HTML
    -->
<form action="" method="post">
<label for="numero">Numero:</label>
<input type="text" name="numero" id="numero" placeholder="Introduce un numero amigo">
<button type="submit">Generar Tabla</button>
<link href="estilos.css" rel = "stylesheet" type ="text/css">
</form>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST["numero"];

        if ($numero >= 0) {
            echo "<h2>Tabla de multiplicar del número $numero</h2>";
            echo "<table>";
            echo "<tr><th>Multiplicación</th><th>Resultado</th></tr>";

            // Generar tabla de multiplicar
            for ($i = 1; $i <= 10; $i++) {
                $resultado = $numero * $i;
                echo "<tr><td>$numero x $i</td><td>$resultado</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Por favor, ingresa un número válido.</p>";
        }
    } else {
        echo "<p>Error: No se recibió ningún número.</p>";
    }
?>



</body>
</html>