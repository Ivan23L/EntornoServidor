<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para nuevos Animes</title>
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

        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenid@ ".$_SESSION["usuario"]."</h2>";
        }else{
            //CUIDADO AMIGO esta función es peligrosa, tiene que ejecutarse antes de que
            //se ejecute el código body
            header("location: ../animes/usuario/inicioSesion.php");
            exit;
        }
    ?>
    <!-- 
    El formulario de los animes lo crearemos en un fichero llamado “nuevo_anime.php” y tendrá los siguientes campos:
        -titulo: Es obligatorio y tendrá como máximo 80 caracteres. Admite cualquier tipo de carácter.
        -nombre_estudio: Es obligatorio y se elegirá mediante un campo de tipo select. Para crear este select primero haremos un array unidimensional con nombres de estudios de anime (al menos 5, puedes coger los nombres de la base de datos). 
        Los option del select se crearán de manera dinámica en un bucle recorriendo dicho array y creando un option por cada valor del mismo. 
        -anno_estreno: Es opcional y se elegirá mediante un campo de texto. Sólo aceptará valores numéricos entre 1960 y dentro de 5 años (inclusive). 
        -num_temporadas: Es obligatorio y será un valor numérico entre 1 y 99.
    -->
</head>
<body>
    
    <?php
        // Validación de formulario cuando se envía
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Validar título
            $tmpTitulo = depurar(ucwords(strtolower($_POST['titulo'])));
            if ($tmpTitulo == ''){
                $errorTitulo = "Es obligatorio.";
            }else{
                if(strlen($tmpTitulo) > 80){
                    $errorTitulo = "No puede superar los 80 caracteres.";
                }else{
                    $titulo = $tmpTitulo;
                }
            }

            // Validar estudio seleccionado
            $tmpNombreEstudio = depurar(ucwords(strtolower($_POST['nombreEstudio'])));
            if ($tmpNombreEstudio == '') {
                $errorNombreEstudio = "El nombre del estudio es obligatorio. Escoge uno.";
            }else{
                $nombreEstudio = $tmpNombreEstudio;
            }

            // Validar año de estreno (opcional)
            $tmpAnioEstreno = depurar($_POST['anioEstreno']);
            $anioActual = date("Y");
            $anioEstrenoMaximo = $anioActual+5;
            // Verificar que el año esté en el rango permitido
            if($tmpAnioEstreno == ''){
                $errorAnio = "Es obligatorio para la base de datos";
            }else{
                if(filter_var($tmpAnioEstreno, FILTER_VALIDATE_INT) === FALSE){
                    $errorAnio = "Debe ser un número entero.";
                }else{
                    if(($tmpAnioEstreno < 1960)||($tmpAnioEstreno > $anioEstrenoMaximo)){
                        $errorAnio = "No puede ser menor a 1960 ni mayor que ".$anioEstrenoMaximo." este último incluido.";
                    }else{
                        $anioEstreno = $tmpAnioEstreno;
                    }
                }
            }

            // Validar número de temporadas
            $tmpNumeroTemporadas = depurar($_POST['numeroTemporadas']);
            if ($tmpNumeroTemporadas == ''){
                $errorNumTemporadas = "Es obligatorio.";
            }else{
                if(filter_var($tmpNumeroTemporadas, FILTER_VALIDATE_INT) === FALSE){
                    $errorNumTemporadas = "Debe ser un número entero.";
                }else{
                    if(($tmpNumeroTemporadas < 1)||($tmpNumeroTemporadas > 99)){
                        $errorNumTemporadas = "No puede ser menor a 1 ni mayor que 99";
                    }else{
                        $numeroTemporadas = $tmpNumeroTemporadas;
                    }
                }
            } 

            //var_dump($_FILES["imagen"]); muestra información detallada sobre la variable en este caso imagen
            /*  array(5) {
                    ["name"] => string(10) "foto.jpg"           nombre original del archivo

                    ["type"] => string(10) "image/jpeg"         tipo de contenido del archivo, tipo MIME

                    ["tmp_name"] => string(14) "/tmp/php1234"   ruta temporal en el servidor donde PHP almacena el archivo

                    ["error"] => int(0)                         (0) → No hay errores.   (1) → El archivo excede el límite en phpini  (2) → El archivo excede el límite del formulario.  
                    (3) → El archivo fue parcialmente cargado.     (4) → No se seleccionó ningún archivo.   (6) → No se encontró un directorio temporal.    
                    (7) → No se pudo escribir el archivo en el disco.      (8) → Una extensión de PHP detuvo la carga del archivo.
                    
                    ["size"] => int(2048)                       tamaño del archivo en bytes   1byte=8bits                   
                }
            */
            //$_FILES es un array BIDIMENSIONAL, mientras que $_POST es un array UNIDIMENSIONAL
            $imagen = $_FILES["imagen"]["name"];
            $ubicacionTemporal = $_FILES["imagen"]["tmp_name"];
            $ubicacionFinal = "./../animes/imagenes/$imagen";
            $imagenTipo = $_FILES["imagen"]["type"];

            //mueve el archivo que se ha cargado de una ubicación a otra
            move_uploaded_file($ubicacionTemporal, $ubicacionFinal);

            //Si todo está correcto añado los datos a la base de datos
            if(isset($titulo) && isset($nombreEstudio) && isset($anioEstreno) && isset($numeroTemporadas) && isset($ubicacionFinal)){
                
                /* $sql = "INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen)
                    VALUES ('$titulo','$nombreEstudio','$anioEstreno','$numeroTemporadas', '$ubicacionFinal')";
                $_conexion -> query($sql); */
                
                //1. Preparar
                $sql = $_conexion -> prepare("INSERT INTO animes
                    (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen)
                    VALUES (?, ?, ?, ?, ?)"
                );
                //2. Enlazado
                $sql -> bind_param("ssiis",
                    $titulo, $nombreEstudio, $anioEstreno,
                    $numeroTemporadas, $ubicacionFinal
                );
                //3. Ejecución
                $sql -> execute();
                ?>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header text-center bg-primary text-white">
                                <h1>Se ha añadido esto correctamente a Animes, amigo:</h1>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Título del anime:</strong> <?php echo "$titulo"; ?></li>
                                    <li class="list-group-item"><strong>Nombre del estudio al que pertenece:</strong> <?php echo "$nombreEstudio"; ?></li>
                                    <li class="list-group-item"><strong>Año de estreno del anime:</strong> <?php echo "$anioEstreno"; ?></li>
                                    <li class="list-group-item"><strong>Número de temporadas total:</strong> <?php echo "$numeroTemporadas"; ?></li>
                                    <li class="list-group-item"><strong>La imagen:</strong> <?php echo "$ubicacionFinal"; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
        $sql = "SELECT nombre_estudio FROM estudios";
        $resultado = $_conexion -> query($sql);
        $estudios = [];
        /* fetch_assoc() devuelve una fila de resultados como un array asociativo. Esto significa que podrás acceder
        a cada columna de la fila por su nombre */
        while($fila = $resultado -> fetch_assoc()){
            array_push($estudios, $fila["nombre_estudio"]);
        }
    ?>
        
    <div class="container mt-5">
        <h1>Formulario para nuevos Animes</h1>
        <!-- enctype="multipart/form-data" para que el formulario pueda leer imagenes -->
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <!-- Título del anime -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del anime:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" >
                <?php if (isset($errorTitulo)) echo "<span class='error'>$errorTitulo</span>"; ?>
            </div>
            
            <!-- Nombre del estudio -->
            <div class="mb-3">
                <select id="nombreEstudio" name="nombreEstudio" class="form-select form-select-lg">
                    <option value="">---Selecciona un estudio---</option>
                    <?php
                    foreach ($estudios as $estudio): ?>
                        <!-- Ambas formas php las interpreta de la misma manera, está creando un option con el valor $estudio e imprimiendolo en el select -->
                        <option value="<?php echo $estudio;?>"><?= $estudio ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errorNombreEstudio)) echo "<span class='error'>$errorNombreEstudio</span>"; ?>
            </div>

            <!-- Año de estreno -->
            <div class="mb-3">
                <label for="anioEstreno" class="form-label">Año de estreno:</label>
                <input type="text" class="form-control" name="anioEstreno" id="anioEstreno" >
                <?php if (isset($errorAnio)) echo "<span class='error'>$errorAnio</span>"; ?>
            </div>

            <!-- Número de temporadas que tiene -->
            <div class="mb-3">
                <label for="numeroTemporadas" class="form-label">Número de temporadas del anime:</label>
                <input type="text" class="form-control" name="numeroTemporadas" id="numeroTemporadas" >
                <?php if (isset($errorNumTemporadas)) echo "<span class='error'>$errorNumTemporadas</span>"; ?>
            </div>

            <!-- Campo para añadir imagen al anime -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" >
                <?php if (isset($errorImagen)) echo "<span class='error'>$errorImagen</span>"; ?>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Añadir anime a la BBDD</button>
                <a href="../animes/index.php" class="btn btn-secondary">Volver al index</a>
            </div>
        </form>
    </div>
    <?php
    if(isset($titulo) && isset($nombreEstudio) && isset($anioEstreno) && isset($numeroTemporadas) && isset($ubicacionFinal)){
    
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>