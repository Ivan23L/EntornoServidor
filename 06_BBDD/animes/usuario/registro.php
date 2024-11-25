<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>
    <!-- Aplico CSS de BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error{
            color: red;
        }
        .container{
            border:1px solid chocolate;
            margin:25px;
            padding:25px;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );   
        require('../../../05_funciones/depurar.php');
        require('../conexion.php');
    ?>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmpUsuario = $_POST["usuario"];
            $tmpContrasena = $_POST["contrasena"];

            //debido a que la contraseña está cifrada tenemos que hacer su passwordHash
            $contrasena_cifrada = password_hash($tmpContrasena,PASSWORD_DEFAULT);

            //Introduzco en mi base de datos dentro de la tabla usuarios. el nombre de usuario y contraseña
            $sql = "INSERT INTO usuarios VALUES ('$tmpUsuario','$contrasena_cifrada')";
            $_conexion -> query($sql);

            header("location: incioSesion.php");
            exit;
        }
    ?>
        
    <div class="container mt-5">
        <h1>Registro de usuario</h1>
        <!-- enctype="multipart/form-data" para que el formulario pueda leer imagenes -->
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <!-- Usuario -->
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" >
                <?php if (isset($errorUsuario)) echo "<span class='error'>$errorUsuario</span>"; ?>
            </div>
           
            <!-- Contraseña de usuario -->
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" >
                <?php if (isset($errorContrasena)) echo "<span class='error'>$errorContrasena</span>"; ?>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Resgistrarse">
                <a href="./inicioSesion.php" class="btn btn-secondary">Inicia sesión</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>