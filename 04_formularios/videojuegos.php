<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Videojuegos</title>
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
    <!-- 
        Realiza un formulario php sobre videojuegos que contenga:
            -titulo: entre 1-80 caracteres, cualquier caracter
            -consola: A elegir entre Nintendo Switch, PS5, PS4, Xbox Series X/S (radio button) con 1 select
            -fecha de lanzamiento: el videojuego más antiguo admisible será del 1 de enero de 1947,
                y el más nuevo en el futuro no podrá ser dentro de más de 5 años (a partir de hoy)
            -PEGI: Será un select a elegir entre 3, 7, 12, 16, 18
            -descripción: entre 0 y 255 caracteres, cualquier caracter (será un campo opcional)

            Validar dichos datos

            IMPORTANTE AMIGOOO

            htmlspecialchars(): convierte caracteres especiales en su representación HTML (por ejemplo, convierte & en &amp;
            Esto ayuda a prevenir ataques de inyección de código HTML o JavaScript. Al usar esta función, los caracteres que podrían tener un significado 
            especial en HTML son "escapados" y no serán interpretados como código HTML por el navegador.
            trim(): elimina los espacios en blanco (o caracteres de control:esc, tab) al principio y al final de la cadena.
    -->
</head>
<body>
    <?php
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
            $tmpTitulo =depurar($_POST['titulo']);
            $tmpConsola = $_POST['consola'];
            $tmpFecha = $_POST['fechaLanzamiento'];
            $tmpPegi = $_POST['pegi'];
            $tmpDescripcion = isset($_POST['descripcion']) ? trim(htmlspecialchars($_POST['descripcion'])) : '';

            // Validar título
            if ($tmpTitulo == "" || strlen($tmpTitulo) < 1 || strlen($tmpTitulo) > 80) {
                $errorTitulo = "El título debe tener entre 1 y 80 caracteres.";
            }else{
                $titulo = $tmpTitulo;
            }

            // Validar consola
            if ($tmpConsola == "") {
                $errorConsola = "Debe seleccionar una consola. ME ENFADAS";
            }else{
                $consola = $tmpConsola;
            }

            /* 
            OTRA FORMA IGUAL 
            $consolasValidas = ["PS4", "PS5", "Nintendo Switch", "Xbox Series X/S"];
            if (!in_array($tmpConsola, $consolasValidas)) {
                $errorConsola = "ME ENFADAS MUCHO AMIGO";
            }else{
                $consola = $tmpConsola;
            } 
            
            */

            // Validar fecha de lanzamiento
            /*  
                Esta línea convierte la fecha '1947-01-01' a un timestamp (un número entero que representa la cantidad de segundos transcurridos 
                desde la medianoche del 1 de enero de 1970 en UTC, conocido como Unix Epoch).
                El resultado es un valor de tipo entero que representa la fecha 1 de enero de 1947. Esta es la fecha mínima admisible

                Ejemplo: Si usas echo $fechaMin;, mostraría algo como: -1052284800, que es la representación en segundos de la fecha '1947-01-01' 
            */
            $fechaMin = strtotime('1947-01-01');
            $fechaMax = strtotime('+5 years');
            $fechaUsuario = strtotime($tmpFecha);

            if ($tmpFecha == "" || $fechaUsuario < $fechaMin || $fechaUsuario > $fechaMax) {
                $errorFecha = "La fecha de lanzamiento debe estar entre el 1 de enero de 1947 y 5 años en el futuro. LEA BIEN AMIGO";
            }else{
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmpFecha)){
                    $errorFecha = "Formato de fecha incorrecto";
                }else{
                    $fecha = $tmpFecha;
                }
            }

            // Validar PEGI
            $pegisValidos = [3, 7, 12, 16, 18];
            if (!in_array($tmpPegi, $pegisValidos)) {
                $errorPegi = "Debe seleccionar un PEGI válido (3, 7, 12, 16, 18). LEA BIEN";
            }else{
                $pegi = $tmpPegi;
            }

            // Validar descripción (máximo 255 caracteres)
            if (strlen($tmpDescripcion) > 255 && $tmpDescripcion != "") {
                $errorDescripcion = "La descripción no puede tener más de 255 caracteres. LEA BIEN";
            }else{
                $descripcion = $tmpDescripcion;
            }

            
        }
    ?>

    <div class="container mt-5">
        <h1>Formulario de Videojuego</h1>

        <form class="col-6" action="" method="post">
            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" >
                <?php if (isset($errorTitulo)) echo "<span class='error'>$errorTitulo</span>"; ?>
            </div>

            <!-- Consola -->
            <div class="mb-3">
                <label class="form-label">Consola:</label><br>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="consola" value="Nintendo Switch" <?php echo isset($tmpConsola) && $tmpConsola == 'Nintendo Switch' ? 'checked' : ''; ?>> Nintendo Switch
                </div>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="consola" value="PS5" <?php echo isset($tmpConsola) && $tmpConsola == 'PS5' ? 'checked' : ''; ?>> PS5
                </div>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="consola" value="PS4" <?php echo isset($tmpConsola) && $tmpConsola == 'PS4' ? 'checked' : ''; ?>> PS4
                </div>
                <div class="form-check">
                <input class = "form-check-input" type="radio" name="consola" value="Xbox Series X/S" <?php echo isset($tmpConsola) && $tmpConsola == 'XboxSeries' ? 'checked' : ''; ?>> Xbox Series X/S
                </div>
                <?php if (isset($errorConsola)) echo "<span class='error'>$errorConsola</span>"; ?>
            </div>

            <!-- Fecha de Lanzamiento -->
            <div class="mb-3">
                <label for="fecha_lanzamiento" class="form-label">Fecha de Lanzamiento:</label>
                <input type="date" class="form-control" name="fechaLanzamiento" id="fechaLanzamiento">
                <?php if (isset($errorFecha)) echo "<span class='error'>$errorFecha</span>"; ?>
            </div>

            <!-- PEGI -->
            <div class="mb-3">
                <label for="pegi" class="form-label">PEGI:</label>
                <select class="form-select" name="pegi" id="pegi">
                    <option disabled selected hidden>--- ¿Cual es su PEGI? ---</option>
                    <option value="3" >3</option>
                    <option value="7" >7</option>
                    <option value="12" >12</option>
                    <option value="16" >16</option>
                    <option value="18" >18</option>
                </select>
                <?php if (isset($errorPegi)) echo "<span class='error'>$errorPegi</span>"; ?>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción (opcional):</label>
                <!-- Podría poner maxlength="255"-->
                <textarea class="form-control" name="descripcion" id="descripcion" rows="4"></textarea>
                <?php if (isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>"; ?>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        
            <!-- OTRA FORMA DE HACER ESTO
             // Si no hay errores, mostrar los datos enviados
            //No sé si añadir:  && isset($descripcion)
            if (isset($titulo) && isset($consola) && isset($fecha) && isset($pegi)) {
                echo "<div class='container mt-4'>";
                echo "<h4>Bieeeeeeeeeen......campeón sabe leer</h4>";
                echo "<ul>
                            <li>Título: $titulo</li>
                            <li>Consola: $consola</li>
                            <li>Fecha de Lanzamiento: $fecha</li>
                            <li>PEGI: $pegi</li>
                            <li>Descripción: $descripcion</li>
                     </ul>";
                echo "</div>";
            } -->
    </div>
    <?php
        if(isset($titulo) && isset($consola) && isset($fecha) && isset($pegi)){
    ?>
    <div class="container mt-5">
            <h1>Se ha recibido esto amigo:</h1>
            <h5>Titulo: <?php echo "$titulo" ?></h5>
            <h5>Consola: <?php echo "$consola" ?></h5>
            <h5>Fecha de lanzamiento: <?php echo "$fecha" ?></h5>
            <h5>PEGI: <?php echo "$pegi" ?></h5>
            <h5>Descripción: <?php echo "$descripcion" ?></h5>
        <?php 
            } 
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
