<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para editar animes</title>
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
        require('conexion.php');

        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenid@ ".$_SESSION["usuario"]."</h2>";
        }else{
            //CUIDADO AMIGO esta función es peligrosa, tiene que ejecutarse antes de que
            //se ejecute el código body
            header("location: ./usuario/inicioSesion.php");
            exit;
        }
    ?>
</head>
<body>
    
    <?php
        $idAnime = $_GET["id_anime"];

        /* $sql = "SELECT * FROM animes WHERE id_anime = $idAnime";
        $resultado = $_conexion ->query($sql); */
        
        //1. Prepare
        $sql = $_conexion -> prepare("SELECT * FROM animes WHERE id_anime = ?");

        //2. Bind
        $sql -> bind_param("i", $idAnime);

        //3. Excute
        $sql -> execute();

        //4. Retrieve
        $resultado = $sql -> get_result();

        //Guardo en variables mías las columnas de mi base de datos
        while($fila = $resultado -> fetch_assoc()){
            $titulo = $fila["titulo"];
            $nombreEstudio = $fila["nombre_estudio"];
            $anioEstreno = $fila["anno_estreno"];
            $numeroTemporadas = $fila["num_temporadas"];
            $imagen = $fila["imagen"];
        }


        //para que el select de nombreEstudio sea dinámico
        $sql = "SELECT nombre_estudio FROM estudios";
        $resultado = $_conexion -> query($sql);
        $estudios = [];
        /* fetch_assoc() devuelve una fila de resultados como un array asociativo. Esto significa que podrás acceder
        a cada columna de la fila por su nombre */
        while($fila = $resultado -> fetch_assoc()){
            array_push($estudios, $fila["nombre_estudio"]);
        }


        //Cuando se pulsa el botón de editar se recogen estos datos de NUESTRO formulario en las variables para posteriormente modificarlos
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $idAnime = $_POST["idAnime"];
            $titulo = depurar($_POST["titulo"]);
            $nombreEstudio = depurar($_POST["nombreEstudio"]);
            $anioEstreno = $_POST["anioEstreno"];
            $numeroTemporadas = $_POST["numeroTemporadas"];
            //$imagen = $_POST["imagen"];

            //Aquí es donde estoy editando la base de datos con las variables que han recogido los datos del formulario
            /* $sql = "UPDATE animes SET
                titulo = '$titulo',
                nombre_estudio = '$nombreEstudio',
                anno_estreno = $anioEstreno,
                num_temporadas = $numeroTemporadas 
                    WHERE id_anime = $idAnime
            ";
            $_conexion -> query($sql); */

            //1. Prepare
            $sql = $_conexion -> prepare ("UPDATE animes SET
                titulo = ?,
                nombre_estudio = ?,
                anno_estreno = ?,
                num_temporadas = ?
                WHERE id_anime = ?
            ");

            //2. Binding
            $sql -> bind_param("ssiii",
            $titulo,
            $nombre_estudio,
            $anno_estreno,
            $num_temporadas,
            $id_anime
            );

            //3. Execute
            $sql -> execute();

            //4. Retrieve
            $resultado = $sql -> get_result();

            if(isset($titulo) && isset($nombreEstudio) && isset($anioEstreno) && isset($numeroTemporadas)){
                ?>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header text-center bg-primary text-white">
                                <h1>Se han editado los siguientes datos correctamente en Animes, amigo:</h1>
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
            }
        }
    ?>
        
    <div class="container mt-5">
        <h1>Aquí puedes editar Animes</h1>
        <!-- enctype="multipart/form-data" para que el formulario pueda leer imagenes -->
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <!-- Título del anime -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del anime:</label>
                <input type="text" class="form-control" name="titulo" value="<?php echo $titulo?>">
                <?php if (isset($errorTitulo)) echo "<span class='error'>$errorTitulo</span>"; ?>
            </div>
            
            <!-- Nombre del estudio -->
            <div class="mb-3">
                <select id="nombreEstudio" name="nombreEstudio" class="form-select form-select-lg">
                    <option value="<?php echo $nombreEstudio?>"selected hidden><?php echo $nombreEstudio?></option>
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
                <input type="text" class="form-control" name="anioEstreno" value= "<?php echo $anioEstreno?>">
                <?php if (isset($errorAnio)) echo "<span class='error'>$errorAnio</span>"; ?>
            </div>

            <!-- Número de temporadas que tiene -->
            <div class="mb-3">
                <label for="numeroTemporadas" class="form-label">Número de temporadas del anime:</label>
                <input type="text" class="form-control" name="numeroTemporadas" value= "<?php echo $numeroTemporadas?>">
                <?php if (isset($errorNumTemporadas)) echo "<span class='error'>$errorNumTemporadas</span>"; ?>
            </div>

            <!-- Campo para añadir imagen al anime -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" >
                <?php if (isset($errorImagen)) echo "<span class='error'>$errorImagen</span>"; ?>
            </div>

            <div class="mb-3">
                <input type="hidden" name="idAnime" value="<?php echo $idAnime?>">
                <button type="submit" class="btn btn-primary">Editar Anime</button>
                <a href="index.php" class="btn btn-secondary">Volver al index</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>