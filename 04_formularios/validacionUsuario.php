<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación Usuario</title>
    <!-- Aplico CSS de BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- 
        https://anayamultimedia.es/primer_capitulo/curso-de-php-8-y-mysql-8.pdf

        Crea un formulario con los siguientes campos: DNi, nombre, primer apellido, segundo apellido,
        fecha de nacimiento y correo electronico. Valida el formulario mediante PHP.
        
            -El DNI deberá contener 8 caracteres y una letra. Tenemos que comprobar que la letra
            sea correcta

            -El nombre y los apellidos no deberán contener caracteres especiales y habrá que mostrarlos
            con la primera letra en mayúscula y las demás en minúscula, aunque se hayan introducido en mayúsculas o minúsculas.

            -Si se es menor de 18 años se deberá mostrar un aviso de que se es menor de edad. Además, la persona no podrá tener
            más de 120 años.

            -El correo electrónico deberá estar en formato correcto. No se permitirán además correos electrónicos 
            que contengan palabras malsonantes.(basta con que vetéis 3 palabras malsonantes). Utilizar la función str_contains.
    -->
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
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmpDni = $_POST['dni'];
            $tmpNombre = trim(htmlspecialchars($_POST['nombre']));
            /* la funcion preg_replace elimina todos los espacios añadidos adicionales,
            solo se quedará con uno e ignorará los demás */
            $tmpNombre = preg_replace('!\s+!', ' ', $tmpNombre);
            $tmpApellido1 = htmlspecialchars($_POST['apellido1']);
            $tmpApellido2 = htmlspecialchars($_POST['apellido2']);
            $tmpFecha = $_POST['fecha'];
            $tmpCorreo = htmlspecialchars($_POST['correo']);


            //VALIDAR NOMBRE 
            if($tmpNombre == ''){
                $errorNombre = "El nombre es obligatorio listillo";
            }else{
                if(strlen($tmpNombre)< 2 || strlen($tmpNombre)> 40){
                    $errorNombre = "El nombre debe tener entre 2 y 40 carácteres espabilao";
                }else{
                    //suponemos que solo acepta letras, espacios en blanco y tildes
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/";
                    if(!preg_match($patron, $tmpNombre)){
                        $errorNombre = "El nombre debe tener entre 2 y 40 carácteres. Solamente letras
                        espacios en blanco y tildes";
                    }else{
                        /* primero se pasa todo a minusculas y se convierte la primera letra en mayúscula */
                        $nombre = ucwords(strtolower($tmpNombre));
                    }
                }
            }

            //VALIDAR APELLIDOS1 y APELLIDOS2
            if($tmpApellido1 == ''){
                $errorApellido1 = "El apellido1 es obligatorio listillo";
            }else{
                if(strlen($tmpApellido1)< 2 || strlen($tmpApellido1)> 40){
                    $errorApellido1 = "El apellido1 debe tener entre 2 y 60 carácteres espabilao";
                }else{
                    //suponemos que solo acepta letras, espacios en blanco y tildes
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/";
                    if(!preg_match($patron, $tmpApellido1)){
                        $errorApellido1 = "El apellido1 debe tener entre 2 y 60 carácteres. Solamente letras
                        espacios en blanco y tildes";
                    }else{
                        $apellido1 = ucwords(strtolower($tmpApellido1));
                    }
                }
            }

            //Apellido2
            if($tmpApellido2 == ''){
                $errorApellido2 = "El apellido2 es obligatorio listillo";
            }else{
                if(strlen($tmpApellido2)< 2 || strlen($tmpApellido2)> 60){
                    $errorApellido2 = "El apellido2 debe tener entre 2 y 60 carácteres espabilao";
                }else{
                    //suponemos que solo acepta letras, espacios en blanco y tildes
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/";
                    if(!preg_match($patron, $tmpApellido2)){
                        $errorApellido2 = "El apellido2 debe tener entre 2 y 60 carácteres. Solamente letras
                        espacios en blanco y tildes";
                    }else{
                        $apellido2 = ucwords(strtolower($tmpApellido2));
                    }
                }
            }

            // Validar DNI
            if($tmpDni == ''){
                $errorDni = "El DNI es obligatorio";
            }else{
                $tmpDni = strtoupper($tmpDni);
                $patron = "/^[0-9]{8}[A-Z]$/";
                if(!preg_match($patron,$tmpDni)){
                    $errorDni = "El DNI debe tener 8 dígitos y una letra";
                }else{
                    $numeroDni = substr($tmpDni, 0, 8);
                    $letraDni = substr($tmpDni, 8, 1);
                    
                    $restoDni = $numeroDni % 23;
                    $letraCorrecta = match($restoDni) {
                        0 => "T",
                        1 => "R",
                        2 => "W",
                        3 => "A",
                        4 => "G",
                        5 => "M",
                        6 => "Y",
                        7 => "F",
                        8 => "P",
                        9 => "D",
                        10 => "X",
                        11 => "B",
                        12 => "N",
                        13 => "J",
                        14 => "Z",
                        15 => "S",
                        16 => "Q",
                        17 => "V",
                        18 => "H",
                        19 => "L",
                        20 => "C",
                        21 => "K",
                        22 => "E"
                    };
                    if($letraDni != $letraCorrecta){
                        $errorDni = "La letra del DNI no es correcta";
                    }else{
                        $dni = $tmpDni;
                    }
                }
            }

            //VALIDAR CORREO
            if($tmpCorreo == ''){
                $errorCorreo = "El correo electrónico es obligatorio";
            }else{
                //formato de correo
                $patron = "/^[a-zA-Z0-9\-.+]+@([a-zA-Z0-9-]+.)+[a-zA-Z]+$/";
                if(!preg_match($patron, $tmpCorreo)){
                    $errorCorreo = "El correo no es válido";
                }else{
                    //Banear 3 palabras minimo
                    $palabrasBaneadas = ["corcho", "negrito", "zorrita", "recorcholis", "caracoles"];
                    $palabrasEncontradas = "";
                    foreach($palabrasBaneadas as $palabraBaneada){
                        if(str_contains($tmpCorreo, $palabraBaneada)){
                            $palabrasEncontradas = "$palabraBaneada, " . $palabrasEncontradas;
                        }
                        if($palabrasEncontradas != ''){
                            $errorCorreo = "No se permiten las palabras: $palabrasEncontradas";
                        }else{
                            $correo = $tmpCorreo;
                        }
                    }
                }
            }

            //VALIDAR FECHA DE NACIMIENTO
            if($tmpFecha == '') {
                $errorFecha = "La fecha de nacimiento es obligatoria";
            } else {
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmpFecha)) {
                    $errorFecha = "Formato de fecha incorrecto";
                } else {
                    $fechaActual = date("Y-m-d");
                    list($anioActual,$mesActual,$diaActual) = explode('-',$fechaActual);
                    list($anio,$mes,$dia) = explode('-',$tmpFecha);

                    
                    if($anioActual - $anio < 18) {
                        $errorFecha = "No puedes ser menor de edad";
                    } elseif($anioActual - $anio == 18) {
                        if($mesActual - $mes < 0) {
                            $errorFecha = "No puedes ser menor de edad";
                        } elseif($mesActual - $mes == 0) {
                            if($diaActual - $dia < 0) {
                                $errorFecha = "No puedes ser menor de edad";
                            } else {
                                $fecha = $tmpfecha;
                            }
                        } elseif($mesActual - $mes > 0) {
                            $fecha = $tmpFecha;
                        } 
                    } elseif($anioActual - $anio > 121) {
                        $errorFecha = "No puedes tener más de 120 años";
                    } elseif($anioActual - $anio == 121) {
                        if($mesActual - $mes > 0) {
                            $errorFecha = "No puedes tener más de 120 años";
                        } elseif($mesActual - $mes == 0) {
                            if($diaActual - $dia >= 0) {
                                $errorFecha = "No puedes tener más de 120 años";
                            } else {
                                $fecha = $tmpFecha;
                            }
                        } elseif($mesActual - $mes < 0) {
                            $fecha = $tmpFecha;
                        } 
                    }else{
                        $fecha = $tmpFecha;
                    }
                }
            }
        }

        function depurar($entrada){
            $salida = htmlspecialchars($entrada);
            /* trim quita los espacios a los laterales */
            $salida = trim($salida);
            /* stripslashes quita barras laterales /\ que pueden dar problemas*/
            $salida = stripslashes($salida);
            $salida = preg_replace('!\s+!', ' ', $salida);
            return $salida;
        }
    ?>
    <div class="container">
        <h4>Fecha actual: <?php echo date("d-m-Y") ?></h4>
        <h1>Dame tus datos amigo</h1><br>
        <form class="col-4" action="" method="post">
            <div class="mb-3">
                <label class="form-label">DNI: </label>
                <input type="text" class="form-control" name="dni">
                <?php 
                    if(isset($errorDni)){
                        echo "<span class='error'>$errorDni</span>";
                    }  
                ?>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Nombre: </label>
                <input type="text" class="form-control" name="nombre">
                <?php 
                    if(isset($errorNombre)){
                        echo "<span class='error'>$errorNombre</span>";
                    }  
                ?>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Apellido1: </label>
                <input type="text" class="form-control" name="apellido1">
                <?php 
                    if(isset($errorApellido1)){
                        echo "<span class='error'>$errorApellido1</span>";
                    }  
                ?>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Apellido2: </label>
                <input type="text" class="form-control" name="apellido2">
                <?php 
                    if(isset($errorApellido2)){
                        echo "<span class='error'>$errorApellido2</span>";
                    }  
                ?>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento: </label>
                <input type="date" class="form-control" name="fecha">
                <?php 
                    if(isset($errorFecha)){
                        echo "<span class='error'>$errorFecha</span>";
                    }  
                ?>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="text" class="form-control" name="correo">
                <?php 
                    if(isset($errorCorreo)){
                        echo "<span class='error'>$errorCorreo</span>";
                    }  
                ?>
            </div>
            <br>
            <button type="submit">Enviar</button>
        </form>
        <?php
            if(isset($dni) && isset($correo) && isset($nombre) && isset($apellido1) && isset($apellido2) && isset($fecha)){
        ?>
            <h5><?php echo "$dni" ?></h5>
            <h5><?php echo "$nombre" ?></h5>
            <h5><?php echo "$apellido1" ?></h5>
            <h5><?php echo "$apellido2" ?></h5>
            <h5><?php echo "$fecha" ?></h5>
            <h5><?php echo "$correo" ?></h5>
        <?php 
            } 
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
