
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
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
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        require ('../util/conexion.php');
        require ('../util/depurar.php');

        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenid@ ".$_SESSION["usuario"]."</h2>";
        }else{
            header("location: ./iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
    <?php
        // Verifica que el usuario haya iniciado sesión
        if (!isset($_SESSION["usuario"])) {
            header("Location: iniciar_sesion.php");  // Redirigir si no está autenticado
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger datos del formulario
            $tmpUsuario = $_POST["usuario"];
            $tmpContrasenaActual = $_POST["contrasena_actual"];
            $tmpNuevaContrasena = $_POST["nueva_contrasena"];
            $tmpConfirmarContrasena = $_POST["confirmar_contrasena"];

            // Validar el nombre de usuario
            if ($tmpUsuario == '') {
                $errorUsuario = "El nombre de usuario es obligatorio";
            } else {
                $patron = "/^[a-zA-Z0-9]+$/";  // Solo letras y números
                if (!preg_match($patron, $tmpUsuario)) {
                    $errorUsuario = "El usuario solo puede contener letras y números";
                }
            }

            // Validar las contraseñas
            if ($tmpContrasenaActual == '') {
                $errorContrasenaActual = "La contraseña actual es obligatoria";
            }

            if ($tmpNuevaContrasena == '' || $tmpConfirmarContrasena == '') {
                $errorNuevaContrasena = "La nueva contraseña y la confirmación son obligatorias";
            } else {
                if ($tmpNuevaContrasena != $tmpConfirmarContrasena) {
                    $errorNuevaContrasena = "Las contraseñas no coinciden";
                } else {
                    if (strlen($tmpNuevaContrasena) < 8 || strlen($tmpNuevaContrasena) > 15) {
                        $errorNuevaContrasena = "La contraseña debe tener entre 8 y 15 caracteres";
                    } else {
                        // Contraseña con mayúsculas, minúsculas y números (con el patrón que ya tienes)
                        $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}$/";
                        if (!preg_match($patron, $tmpNuevaContrasena)) {
                            $errorNuevaContrasena = "La nueva contraseña debe contener mayúsculas, minúsculas y números";
                        }
                    }
                }
            }

            // Si no hay errores, proceder a cambiar la contraseña
            if (!isset($errorUsuario) && !isset($errorContrasenaActual) && !isset($errorNuevaContrasena)) {
                // Conexión a la base de datos (asegúrate de que $_conexion está definido)
                $sql = "SELECT * FROM usuarios WHERE usuario = '$tmpUsuario'";
                $resultado = $_conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    // Usuario encontrado, comprobar la contraseña actual
                    $usuarioDb = $resultado->fetch_assoc();

                    if (password_verify($tmpContrasenaActual, $usuarioDb['contrasena'])) {
                        // Contraseña actual correcta, actualizar la nueva contraseña
                        $nuevaContrasenaCifrada = password_hash($tmpNuevaContrasena, PASSWORD_DEFAULT);
                        $sqlUpdate = "UPDATE usuarios SET contrasena = '$nuevaContrasenaCifrada' WHERE usuario = '$tmpUsuario'";
                        $_conexion->query($sqlUpdate);

                        // Redirigir a la página de inicio de sesión después de actualizar
                        header("Location: iniciar_sesion.php?mensaje=contraseña_actualizada");
                        exit;
                    } else {
                        $errorContrasenaActual = "La contraseña actual es incorrecta";
                    }
                } else {
                    $errorUsuario = "El usuario no existe";
                }
            }
        }

    ?>
    <div class="container mt-5">
        <!-- Formulario de cambio de contraseña -->
        <form class="col-6" action="" method="post">
            <div class="mb-3">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo isset($tmpUsuario) ? $tmpUsuario : ''; ?>">
                <?php if (isset($errorUsuario)) echo "<span class='error'>$errorUsuario</span>"; ?>
            </div>
            
            <div class="mb-3">
                <label for="contrasena_actual">Contraseña Actual:</label>
                <input type="password" id="contrasena_actual" name="contrasena_actual">
                <?php if (isset($errorContrasenaActual)) echo "<span class='error'>$errorContrasenaActual</span>"; ?>
            </div>

            <div class="mb-3">
                <label for="nueva_contrasena">Nueva Contraseña:</label>
                <input type="password" id="nueva_contrasena" name="nueva_contrasena">
                <?php if (isset($errorNuevaContrasena)) echo "<span class='error'>$errorNuevaContrasena</span>"; ?>
            </div>

            <div class="mb-3">
                <label for="confirmar_contrasena">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena">
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Cambiar Contraseña</button>
                <a href="../index.php" class="btn btn-danger">Volver al index</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
