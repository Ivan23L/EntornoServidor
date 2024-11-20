<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar libros</title>
    
    <!-- Aplico CSS de BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error{
            color: red;
        }
        .container{
            border:5px solid darkblue;
            margin:25px;
            padding:25px;
        }
    </style>
</head>
<body>
    <?php
        //Función para sanear los datos del formulario
        function depurar($entrada){
            $salida = htmlspecialchars($entrada);
            /* trim quita los espacios a los laterales */
            $salida = trim($salida);
            /* stripslashes quita barras laterales /\ que pueden dar problemas*/
            $salida = stripslashes($salida);
            $salida = preg_replace('!\s+!', ' ', $salida);
            return $salida;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir los datos del formulario
            $tmpTitulo = depurar($_POST['titulo']);
            $tmpPaginas = depurar($_POST['paginas']);
            $tmpGenero = depurar($_POST['genero']);
            $tmpSecuela = depurar($_POST['secuela']);
            $tmpFecha = depurar($_POST['fechaPublicacion']);
            $tmpSinopsis = depurar($_POST['sinopsis']);

            // Validar titulo del libro
            if($tmpTitulo == ""){
                $errorTitulo = "El título es obligatorio";
            }else{
                //La primera es letra si o sí
                $patron = "/^[a-zA-Z]{1}[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,; ]+$/";    
                if(!preg_match($patron, $tmpTitulo)){
                    $errorTitulo = "Solo se admiten letras (+tildes), la ñ, espacios en blanco y punto, coma, punto y coma. La primera tiene que ser letra";
                }else{
                    $titulo = ucwords(strtolower($tmpTitulo));
                }
            }

            // Validar páginas que tiene el libro
            if($tmpPaginas == ""){
                $errorPaginas = "Las páginas son obligatorias";
            }else{   
                if(filter_var($tmpPaginas, FILTER_VALIDATE_INT) === FALSE){
                    $errorPaginas = "Debe ser un número entero";
                }else{
                    if(($tmpPaginas < 10)||($tmpPaginas > 9999)){
                        $errorPaginas = "Debe tener entre 10 y 9999 páginas";
                    }else{
                        $paginas = $tmpPaginas;
                    }
                }
            }

            // Validar Género del libro
            if ($tmpGenero == "") {
                $errorGenero = "Debe seleccionar un género. ME ENFADAS";
            }else{
                $genero = $tmpGenero;
            }

            // Validar si tiene secuelas
            if ($tmpSecuela == "") {
                $secuela = "No";
            }else{
                $secuela = $tmpSecuela;
            }
            
            // Validar fecha de publiación (entre 1 de enero de 1800 y dentro de 3 años)
            $fechaMin = strtotime('1800-01-01');
            $fechaMax = strtotime('+3 years');
            $fechaUsuario = strtotime($tmpFecha);

            if ($fechaUsuario < $fechaMin || $fechaUsuario > $fechaMax) {
                $errorFecha = "La fecha de publicación debe estar entre el 1 de enero de 1800 y dentro de 3 años en el futuro.";
            }else{
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmpFecha)){
                    $errorFecha = "Formato de fecha incorrecto";
                }else{
                    $fecha = $tmpFecha;
                }
            }

            //Validar sinopsis
            if (strlen($tmpSinopsis) > 200) {
                $errorSinopsis = "No puede ocupar más de 200 palabras letras";
            }else{
                $patron = "/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ]+$/";    
                if(!preg_match($patron, $tmpSinopsis)){
                    $errorSinopsis = "Solo puede contener letras con o sin tilde, ñ y espacios en blanco";
                }else{
                    $sinopsis = $tmpSinopsis;
                }
            }

        }    
    ?>
    <div class="container mt-5">
        <h1>Formulario de validación sobre libros</h1>

        <form class="col-6" action="" method="post">
            <!-- Titulo del libro -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del libro:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" >
                <?php if (isset($errorTitulo)) echo "<span class='error'>$errorTitulo</span>"; ?>
            </div>
            
            <!-- Páginas del libro -->
            <div class="mb-3">
                <label for="paginas" class="form-label">Páginas del libro:</label>
                <input type="text" class="form-control" name="paginas" id="paginas" >
                <?php if (isset($errorPaginas)) echo "<span class='error'>$errorPaginas</span>"; ?>
            </div>

            <!-- Género del libro -->
            <div class="mb-3">
                <label class="form-label">Género del libro:</label><br>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="genero" value="Fantasía" <?php echo isset($tmpGenero) && $tmpGenero == 'Fantasía' ? 'checked' : ''; ?>> Fantasía
                </div>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="genero" value="Ciencia Ficción" <?php echo isset($tmpGenero) && $tmpGenero == 'Ciencia Ficción' ? 'checked' : ''; ?>> Ciencia Ficción
                </div>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="genero" value="Romance" <?php echo isset($tmpGenero) && $tmpGenero == 'Romance' ? 'checked' : ''; ?>> Romance
                </div>
                <div class="form-check">
                <input class = "form-check-input" type="radio" name="genero" value="Drama" <?php echo isset($tmpGenero) && $tmpGenero == 'Drama' ? 'checked' : ''; ?>> Drama
                </div>
                <?php if (isset($errorGenero)) echo "<span class='error'>$errorGenero</span>"; ?>
            </div>

            <!-- Select si tiene secuela o no el libro -->
            <div class="mb-3">
                <label for="secuela" class="form-label">¿Tiene secuela?:</label>
                <select class="form-select" name="secuela" id="secuela">
                    <option disabled selected hidden>--- ¿Tiene secuela este libro? ---</option>
                    <option value="Sí" >Sí</option>
                    <option value="No" >No</option>
                </select>
                <?php if (isset($errorSecuela)) echo "<span class='error'>$errorSecuela</span>"; ?>
            </div>

            <!-- Fecha de Publicación -->
            <div class="mb-3">
                <label for="fechaPublicacion" class="form-label">Fecha de Publicación:</label>
                <input type="date" class="form-control" name="fechaPublicacion" id="fechaPublicacion">
                <?php if (isset($errorFecha)) echo "<span class='error'>$errorFecha</span>"; ?>
            </div>

            <!-- Sinopsis -->
            <div class="mb-3">
                <label for="sinopsis" class="form-label">Sinopsis:</label>
                <!-- Podría poner maxlength="200"-->
                <textarea class="form-control" name="sinopsis" id="sinopsis" rows="4"></textarea>
                <?php if (isset($errorSinopsis)) echo "<span class='error'>$errorSinopsis</span>"; ?>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    
    <!-- Mostrar si se ha recibido todo bien por pantalla) -->
    <?php
    if(isset($titulo) && isset($paginas) && isset($genero) && isset($secuela) && isset($fecha) && isset($sinopsis)){
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h1>Se ha recibido esto correctamente:</h1>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Título del libro:</strong> <?php echo "$titulo"; ?></li>
                    <li class="list-group-item"><strong>Páginas del libro:</strong> <?php echo "$paginas"; ?></li>
                    <li class="list-group-item"><strong>Género del libro:</strong> <?php echo "$genero"; ?></li>
                    <li class="list-group-item"><strong>¿Tiene secuela?:</strong> <?php echo "$secuela"; ?></li>
                    <li class="list-group-item"><strong>Fecha de publicación:</strong> <?php echo "$fecha"; ?></li>
                    <li class="list-group-item"><strong>Sinopsis:</strong> <?php echo "$sinopsis"; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php 
        } 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>