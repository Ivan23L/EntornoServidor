<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <!-- Aplico CSS de BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <div class="container">
        <!-- Content here -->
        <h1>Formulario para Usuario</h1>
        <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST")){
                $usuarioTemporal = $_POST["usuario"];
                $nombreTemporal = $_POST["nombre"];
                $apellidosTemporal = $_POST["apellidos"];

                //VALIDACIÓN USUARIO
                if($usuarioTemporal == ''){
                    $errorUsuario = "El usuario es obligatorio espabilao";
                }else{
                    //suponemos que solo letras de la A a la Z (Mayus o minus), numeros y barrabajas
                    //y debe contener entre 4 y 12 caracteres
                    $patron = "/^[a-zA-Z0-9_]{4,12}$/";
                    if(!preg_match($patron, $usuarioTemporal)){
                        $errorUsuario = "El usuario debe contener entre 4 y 12 letras, números o barrabajas";
                    }else{
                        $usuario = $usuarioTemporal;
                    }
                }

                //VALIDACIÓN NOMBRE
                if($nombreTemporal == ''){
                    $errorNombre = "El nombre es obligatorio listillo";
                }else{
                    if(strlen($nombreTemporal)< 2 || strlen($nombreTemporal)> 40){
                        $errorNombre = "El nombre debe tener entre 2 y 40 carácteres espabilao";
                    }else{
                        //suponemos que solo acepta letras, espacios en blanco y tildes
                        $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/";
                        if(!preg_match($patron, $nombreTemporal)){
                            $errorNombre = "El nombre debe tener entre 2 y 40 carácteres. Solamente letras
                            espacios en blanco y tildes";
                        }else{
                            $nombre = $nombreTemporal;
                        }
                    }
                }

                //VALIDACIÓN APELLIDOS
                if($apellidosTemporal == ''){
                    $errorApellido = "Los apellidos son obligatorios listillo";
                }else{
                    if(strlen($apellidosTemporal)< 2 || strlen($apellidosTemporal)> 60){
                        $errorApellido = "Los apellidos deben tener entre 2 y 60 carácteres espabilao";
                    }else{
                        //suponemos que solo acepta letras, espacios en blanco y tildes
                        $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/";
                        if(!preg_match($patron, $apellidosTemporal)){
                            $errorApellido = "Los aoellidos deben tener entre 2 y 60 carácteres. Solamente letras
                            espacios en blanco y tildes";
                        }else{
                            $apellidos = $apellidosTemporal;
                        }
                    }
                }
            }
        ?>

        <form class="col-4" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario">
                <?php 
                    if(isset($errorUsuario)){
                        echo "<span class='error'>$errorUsuario</span>";
                    }  
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
                <?php 
                    if(isset($errorNombre)){
                        echo "<span class='error'>$errorNombre</span>";
                    }  
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
                <?php 
                    if(isset($errorApellido)){
                        echo "<span class='error'>$errorApellido</span>";
                    }  
                ?>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Enviar">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>