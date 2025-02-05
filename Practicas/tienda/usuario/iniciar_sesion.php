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
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            //si el usuario existe va a devolver una fila con el usuario y contraseña
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

            //
            $resultado = $_conexion -> query($sql);

            //veo lo que muestra el resultado si no se detecta nombre de usuario
            //var_dump($resultado); SI NUM_ROWS == 0 EL USUARIO NO ESTÁ REGISTRADO. NUM_ROWS == 1 SÍ

            if($resultado -> num_rows == 0){
                echo "<h2>El usuario $usuario no existe</h2>";
            }else{
                $datosUsuario = $resultado -> fetch_assoc();
                /* Podemos acceder a:
                $datosUsuario["usuario"]
                $datosContrasena["contrasena"]
                */
                //password_verify es la función inversa a el hash
                $accesoConcedido = password_verify($contrasena,$datosUsuario["contrasena"]);
                //compruebo que salga correcto (saldría un booleano TRUE si la contraseña es correcta)
                //var_dump($accesoConcedido);   Si no está la contraseña y el usuario sale FALSE

                if($accesoConcedido){
                    //bien
                    session_start();
                    //La sesión se almacena en el servidor y guarda información del usuario
                    $_SESSION["usuario"] = $usuario;
                    
                    //index principal de la tienda
                    header("location: ../index.php");
                    exit;
                }else{
                    echo "<h2>La contraseña es incorrecta.</h2>";
                }
            }
        }
    ?>
        
    <div class="container mt-5">
        <h1>Inicio de sesión</h1>
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
                <input type="submit" class="btn btn-primary" value="Iniciar sesión">
                <a href="../index.php" class="btn btn-danger">Volver a la tienda</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>