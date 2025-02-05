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
        require('../util/depurar.php');
        require('../util/conexion.php');
    ?>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmpUsuario = $_POST["usuario"];
            $tmpContrasena = $_POST["contrasena"];

            //Validar usuario
            if($tmpUsuario == ''){
                $errorUsuario = "Obligatorio";
            }else{
                if(strlen($tmpUsuario)< 3 || strlen($tmpUsuario)> 15){
                    $errorUsuario = "El apellido2 debe tener entre 3 y 15 carácteres";
                }else{
                    //solo acepta letras y números
                    $patron = "/^[a-zA-Z0-9]+$/";
                    if(!preg_match($patron, $tmpUsuario)){
                        $tmpUsuario = "Solo letras y números";
                    }else{
                        $usuario = ucwords(strtolower($tmpUsuario));
                    }
                }
            }

            //Validar contraseña
            if($tmpContrasena == ''){
                $errorContrasena = "Obligatorio";
            }else{
                if(strlen($tmpContrasena)< 8 || strlen($tmpContrasena)> 15){
                    $errorUsuario = "La contraseña debe tener entre 8 y 15 carácteres";
                }else{
                    //patron de contraseña de la pagina REGEX
                    $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
                    if(!preg_match($patron, $tmpContrasena)){
                        $errorContrasena = "Tiene que contener mayúsculas y minúsculas, algún número y puede tener caracteres especiales.";
                    }else{
                        $contrasena = $tmpContrasena;
                    }
                }
            }
            

            if(isset($contrasena) && isset($usuario)){
                //debido a que la contraseña está cifrada tenemos que hacer su passwordHash
                $contrasena_cifrada = password_hash($contrasena,PASSWORD_DEFAULT);

                //Introduzco en mi base de datos dentro de la tabla usuarios. el nombre de usuario y contraseña
                $sql = "INSERT INTO usuarios VALUES ('$tmpUsuario','$contrasena_cifrada')";
                $_conexion -> query($sql);

                header("location: inciar_sesion.php");
                exit;
            }
        }
    ?>
        
    <div class="container mt-5">
        <h1>Registro de usuario</h1>
        <form class="col-6" action="" method="post">
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
                <a href="./iniciar_sesion.php" class="btn btn-danger">Volver a la tienda</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>