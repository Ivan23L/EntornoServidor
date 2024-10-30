<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación Usuario</title>
    <!-- 
        Crea un formulario con los siguientes campos: DNi, nombre, primer apellido, segundo apellido,
        fecha de nacimiento y correo electronico. Valida el formulario mediante PHP.
        
            -El DNI deberá contener 8 caracteres y una letra. Tenemos que comprobar que la letra
            sea correcta

            -El nombre y los apellidos no deberán contener caracteres especiales y habrá que mostrarlos
            con la primera letra en mayúscula y las demás en minúscula, aunque se hayan introducido en mayúsculas o minúsculas.

            -Si se es menor de 18 años se deberá mostrar un aviso de que se es menor de edad. Además, la persona no podrá tener
            más de 120 años.

            -El correo electrónico deberá estar en formato correcto. No se permitirán además correos electrónicos 
            que contengan palabras malsonantes.(basta con que vetéis 3 palabras malsonantes). Utilizar la función str_contains.
    -->
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
    ?>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Hola amigo</h1>
    <form action="" method="post">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido1">Primer Apellido:</label>
        <input type="text" id="apellido1" name="apellido1" required><br>

        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" id="apellido2" name="apellido2"><br>

        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" required><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br>

        <button type="submit">Enviar</button>
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dniTemporal = $_POST['dni'];
    $nombreTemporal = $_POST['nombre'];
    $apellido1Temporal = $_POST['apellido1'];
    $apellido2Temporal = $_POST['apellido2'];
    $fechaNacimientoTemporal = $_POST['fechaNacimiento'];
    $correoTemporal = $_POST['correo'];

    // Validar DNI
    if (!preg_match('/^[0-9]{8}[A-Z]$/', $dniTemporal)) {
        echo "DNI inválido. Debe contener 8 números y una letra válida.<br>";
    }

}
?>


</body>
</html>
