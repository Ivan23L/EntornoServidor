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
        // Array de estudios de anime
        $estudios = ['Studio Bind', 'Wit Studio', 'ufotable', 'Toei Animation', 'Bones'];

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
                $anioEstreno = NULL;
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
        }
    ?>
        
    <div class="container mt-5">
        <h1>Formulario para nuevos Animes</h1>

        <form class="col-6" action="" method="post">
            <!-- Título del anime -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del anime:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" >
                <?php if (isset($errorTitulo)) echo "<span class='error'>$errorTitulo</span>"; ?>
            </div>
            
            <!-- Nombre del estudio -->
            <div class="mb-3">
                <select id="nombreEstudio" name="nombreEstudio" class="form-select form-select-lg">
                    <option value="">Selecciona un estudio</option>
                    <?php foreach ($estudios as $estudio): ?>
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

            <button type="submit" class="btn btn-primary">Añadir anime a la BBDD</button>
        </form>

    </div>
    <?php
    if(isset($titulo) && isset($nombreEstudio) && isset($numeroTemporadas)){
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
                    </ul>
                </div>
            </div>
        </div>
    <?php
        //Añado los datos a la base de datos
        $sql = "INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas)
            VALUES ('$titulo','$nombreEstudio','$anioEstreno','$numeroTemporadas')";
        $_conexion -> query($sql);
    } 
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>