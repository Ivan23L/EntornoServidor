<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para nuevos estudios</title>
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
        require('../../05_funciones/depurar.php');
        require('../animes/conexion.php');
    ?>
    <!-- 
    El formulario de los estudios lo crearemos en un fichero llamado “nuevo_estudio.php” y tendrá los siguientes campos:
        -nombre_estudio: Es obligatorio y solo podrá contener letras, números y espacios en blanco.
        -ciudad: Es obligatorio y solo podrá contener letras y espacios en blanco.
 
    -->
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar nombre del estudio
            $tmpNombreEstudio = depurar(ucwords(strtolower($_POST['nombreEstudio'])));
            if (($tmpNombreEstudio == '') || !preg_match("/^[a-zA-Z0-9 ]+$/", $tmpNombreEstudio)) {
                $errorNombreEstudio = "El nombre del estudio es obligatorio y solo puede contener letras, números y espacios.";
            }else{
                $nombreEstudio = $tmpNombreEstudio;
            }
        
            // Validar ciudad
            $tmpCiudad = depurar(ucwords(strtolower($_POST['ciudad'])));
            if (($tmpCiudad == '') || !preg_match("/^[a-zA-Z ]+$/", $tmpCiudad)) {
                $errorCiudad = "La ciudad es obligatoria y solo puede contener letras y espacios.";
            }else{
                $ciudad = $tmpCiudad;
            }

            // Validar año de fundación (obligatorio)
            $tmpAnioFundacion = depurar($_POST['anioFundacion']);
            $anioActual = date("Y");
            $anioFundacionMaximo = $anioActual+5;
            // Verificar que el año esté en el rango permitido
            if($tmpAnioFundacion == ''){
                $errorAnio = "Es obligatorio";
            }else{
                if(filter_var($tmpAnioFundacion, FILTER_VALIDATE_INT) === FALSE){
                    $errorAnio = "Debe ser un número entero.";
                }else{
                    if(($tmpAnioFundacion < 1960)||($tmpAnioEstreno > $anioFundacionMaximo)){
                        $errorAnio = "No puede ser menor a 1960 ni mayor que ".$anioFundacionMaximo." este último incluido.";
                    }else{
                        $anioFundacion = $tmpAnioFundacion;
                    }
                }
            }
        }
    ?>
        
    <div class="container mt-5">
        <h1>Formulario para nuevos Estudios</h1>

        <form class="col-6" action="" method="post">
            <!-- Nombre del estudio al que pertenece -->
            <div class="mb-3">
                <label for="nombreEstudio" class="form-label">Nombre del estudio:</label>
                <input type="text" class="form-control" name="nombreEstudio" id="nombreEstudio" >
                <?php if (isset($errorNombreEstudio)) echo "<span class='error'>$errorNombreEstudio</span>"; ?>
            </div>

            <!-- Nombre de la ciudad -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad a la que pertenece:</label>
                <input type="text" class="form-control" name="ciudad" id="ciudad" >
                <?php if (isset($errorCiudad)) echo "<span class='error'>$errorCiudad</span>"; ?>
            </div>  
            
            <!-- Año de fundación -->
            <div class="mb-3">
                <label for="anioFundacion" class="form-label">Año de fundación:</label>
                <input type="text" class="form-control" name="anioFundacion" id="anioFundacion" >
                <?php if (isset($errorAnio)) echo "<span class='error'>$errorAnio</span>"; ?>
            </div>

            <button type="submit" class="btn btn-primary">Añadir Estudio</button>
        </form>

    </div>
    
    <?php
    if(isset($nombreEstudio) && isset($ciudad) && isset($anioFundacion)){
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h1>Se ha añadido esto correctamente a Estudios, amigo:</h1>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre del estudio:</strong> <?php echo "$nombreEstudio"; ?></li>
                    <li class="list-group-item"><strong>Ciudad:</strong> <?php echo "$ciudad"; ?></li>
                    <li class="list-group-item"><strong>Año de fundación:</strong> <?php echo "$anioFundacion"; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php 
    //Añado los datos a la base de datos
        $sql = "INSERT INTO estudios (nombre_estudio, ciudad, anno_fundacion)
            VALUES ('$nombreEstudio','$ciudad','$anioFundacion')";
        $_conexion -> query($sql);
    } 
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
