<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de la liga</title>
<!-- 
    Equipos de la liga
    -Nombres(letras con tilde, ñ, espacios en blanco y punto)
    -Inicial (3 letras)
    -Ciudad(letras con tilde, ñ, ç y espacios en blanco)
    -Tiene titulo liga(select si o no)
    -Liga (select con opciones: Liga EA Sports, Liga Hypermotion, Liga Primera RFEF)
    -Fecha de fundación (entre hoy y el 18 de diciembre de 1889)
    -Número de jugadores (entre 26 y 32)
-->
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
            $tmpNombre = depurar($_POST['nombre']);
            $tmpIniciales = depurar($_POST['iniciales']);
            $tmpCiudad = depurar($_POST['ciudad']);
            $tmpTitulo = $_POST['titulo'];
            $tmpDivision = $_POST['division'];
            $tmpFecha = $_POST['fechaFundacion'];
            $tmpNumeroJugadores = $_POST['numero'];

            // Validar nombre
            if($tmpNombre == ""){
                $errorNombre = "El nombre es obligatorio";
            }else{
                $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ.]+$/";    
                if(!preg_match($patron, $tmpNombre)){
                    $errorNombre = "Solo se admiten letras (+tildes), la ñ, espacios en blanco y puntos.";
                }else{
                    $nombre = ucwords(strtolower($tmpNombre));
                }
            }

            // Validar iniciales
            if($tmpIniciales == ""){
                $errorInicial = "Las iniciales son obligatorios listillo";
            }else{
                $patron = "/^[a-zA-Z]{3}+$/";    
                if(!preg_match($patron, $tmpIniciales)){
                    $errorInicial = "Solo se admiten letras y deben ser 3";
                }else{
                    $iniciales = strtoupper($tmpIniciales);
                }
            }

            // Validar Ciudad
            if($tmpCiudad == ""){
                $errorCiudad = "La ciudad es obligatorio";
            }else{
                $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑçÇ]+$/";
                if(!preg_match($patron, $tmpCiudad)){
                    $errorCiudad = "Solo se admiten letras + letras con tildes, la ñ, espacios en blanco y la çÇ.";
                }else{
                    $ciudad = ucwords(strtolower($tmpCiudad));
                }
            }

            // Validar titulo de la liga
            if ($tmpTitulo == "") {
                $errorTitulo = "Debes decirme si has ganado o no AMIGO. ME ENFADAS";
            }else{
                $titulo = $tmpDivision;
            }

            // Validar División
            $DivisionesDisponibles = ["Liga EA Sports", "Liga Hypermotion", "Liga Primera RFEF"];
            if (!in_array($tmpDivision, $DivisionesDisponibles)) {
                $errorDivision = "Debe seleccionar una de las divisiones válidas. LEA BIEN";
            }else{
                $division = $tmpDivision;
            }
            
            // Validar fecha de fundación (entre hoy y el 18 de diciembre de 1889)
            if($tmpFecha == '') {
                $errorFecha = "La fecha de fundación es obligatoria";
            } else {
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmpFecha)) {
                    $errorFecha = "Formato de fecha incorrecto";
                } else {
                    $fechaActual = date("Y-m-d");
                    list($anioActual,$mesActual,$diaActual) = explode('-',$fechaActual);
                    list($anio,$mes,$dia) = explode('-',$tmpFecha);

                    
                    if($anioActual == $anio) {
                        if($mesActual == $mes){
                            if($diaActual == $dia){
                                $fecha = $tmpFecha;
                            }elseif($diaActual < $dia){
                                $errorFecha = "No puede ser amigo estás locoOoaooO";
                            }else{
                                $fecha = $tmpFecha;
                            }
                        }elseif($mesActual < $mes){
                            $errorFecha = "mes FUTURO????estás bien??? amigo un poco locoo";
                        }else{
                            $fecha = $tmpFecha;
                        }
                    } elseif($anio > $anioActual){
                        $errorFecha = "No puede ser del futuro ";
                    }elseif($anio <= 1889) {
                        if($anio == 1889) {
                            if($mes == 12){
                                if($dia < 18){
                                    $errorFecha = "Noo puede ser anterior al 18 de diciembre de 1889 amigo";
                                }else{
                                    $fecha = $tmpFecha;
                                }
                            }else{
                                $errorFecha = "No puede ser anterior a diciembre de 1889";
                            }
                        }else{
                            $errorFecha = "No puede ser anterior a 1889";
                        }
                    }else{
                        $fecha = $tmpFecha;
                    }
                }   
            }

            // Validar Número de jugadores (entre 26 y 32)
            if($tmpNumeroJugadores == ""){
                $errorNumerojugadores = "¿Cuántos jugadores hay? es obligatorio";
            }else{
                if(($tmpNumeroJugadores < 26) || ($tmpNumeroJugadores > 32)){
                    $errorNumerojugadores = "Tiene que haber entre 26 y 32 amigooo.";
                }else{
                    $numeroJugadores = $tmpNumeroJugadores;
                }
            }

        }    
    ?>
    <div class="container mt-5">
        <h1>Formulario de equipos de la liga</h1>

        <form class="col-6" action="" method="post">
            <!-- Nombre del Equipo -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Equipo:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" >
                <?php if (isset($errorNombre)) echo "<span class='error'>$errorNombre</span>"; ?>
            </div>
            
            <!-- Iniciales del equipo FCB RMA -->
            <div class="mb-3">
                <label for="inicial" class="form-label">Iniciales del Equipo:</label>
                <input type="text" class="form-control" name="iniciales" id="iniciales" >
                <?php if (isset($errorInicial)) echo "<span class='error'>$errorInicial</span>"; ?>
            </div>

            <!-- Ciudad del Equipo -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad del Equipo:</label>
                <input type="text" class="form-control" name="ciudad" id="ciudad" >
                <?php if (isset($errorCiudad)) echo "<span class='error'>$errorCiudad</span>"; ?>
            </div>

            <!-- Titulo de la liga -->
            <div class="mb-3">
                <label class="form-label">¿Tiene título de liga?:</label><br>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="titulo" value="Sí" <?php echo isset($tmpTitulo) && $tmpTitulo == 'Sí' ? 'checked' : ''; ?>> Sí
                </div>
                <div class="form-check">
                    <input class = "form-check-input" type="radio" name="titulo" value="No" <?php echo isset($tmpTitulo) && $tmpTitulo == 'No' ? 'checked' : ''; ?>> No
                </div>
                <?php if (isset($errorTitulo)) echo "<span class='error'>$errorTitulo</span>"; ?>
            </div>

            <!-- División -->
            <div class="mb-3">
                <label for="division" class="form-label">División:</label>
                <select class="form-select" name="division" id="division">
                    <option disabled selected hidden>--- ¿Cual es su división? ---</option>
                    <option value="Liga EA Sports" >Liga EA Sports</option>
                    <option value="Liga Hypermotion" >Liga Hypermotion</option>
                    <option value="Liga Primera RFEF" >Liga Primera RFEF</option>
                </select>
                <?php if (isset($errorDivision)) echo "<span class='error'>$errorDivision</span>"; ?>
            </div>

            <!-- Fecha de Fundación -->
            <div class="mb-3">
                <label for="fechaFundacion" class="form-label">Fecha de Fundación:</label>
                <input type="date" class="form-control" name="fechaFundacion" id="fechaFundacion">
                <?php if (isset($errorFecha)) echo "<span class='error'>$errorFecha</span>"; ?>
            </div>

            <!-- Número de jugadores entre 26 y 32 -->
            <div class="mb-3">
                <label for="numero" class="form-label">Número de jugadores:</label>
                <input type="text" class="form-control" name="numero" id="numero" >
                <?php if (isset($errorNumerojugadores)) echo "<span class='error'>$errorNumerojugadores</span>"; ?>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    
    <!-- Mostrar si se ha recibido todo bien por pantalla (MODO CHULO AMIGO) -->
    <?php
    if(isset($nombre) && isset($iniciales) && isset($ciudad) && isset($titulo) && isset($division) && isset($fecha) && isset($numeroJugadores)){
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h1>Se ha recibido esto, amigo:</h1>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre del equipo:</strong> <?php echo "$nombre"; ?></li>
                    <li class="list-group-item"><strong>Iniciales del club:</strong> <?php echo "$iniciales"; ?></li>
                    <li class="list-group-item"><strong>Ciudad del equipo:</strong> <?php echo "$ciudad"; ?></li>
                    <li class="list-group-item"><strong>Título conseguido:</strong> <?php echo "$titulo"; ?></li>
                    <li class="list-group-item"><strong>División:</strong> <?php echo "$division"; ?></li>
                    <li class="list-group-item"><strong>Fecha de fundación:</strong> <?php echo "$fecha"; ?></li>
                    <li class="list-group-item"><strong>Jugadores disponibles:</strong> <?php echo "$numeroJugadores"; ?></li>
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