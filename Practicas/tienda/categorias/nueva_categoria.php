<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para nuevas categorías</title>
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

        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenid@ ".$_SESSION["usuario"]."</h2>";
        }else{
            //CUIDADO AMIGO esta función es peligrosa, tiene que ejecutarse (preferiblementejaja) antes de que
            //se ejecute el código body
            header("location: ../usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
    
    <?php
        // Validación de formulario cuando se envía
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Validar categoría
            $tmpCategoria = depurar(ucwords(strtolower($_POST['categoria'])));
            if ($tmpCategoria == ''){
                $errorCategoria = "Es obligatorio.";
            }else{
                if(strlen($tmpCategoria)< 2){
                    $errorCategoria = "Debe tener más de 2 carácteres.";
                }else{
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/";
                    if(!preg_match($patron, $tmpCategoria)){
                        $errorCategoria = "Solo puede tener letras y espacios.";
                    }else{
                        $categoria = $tmpCategoria;
                    }
                }
            }

            // Validar descripción
            $tmpDescripcion = depurar($_POST['descripcion']);
            if ($tmpDescripcion == '') {
                $errorDescripcion = "La descripción de la categoría es obligatoria.";
            }else{
                if(strlen($tmpDescripcion)> 255){
                    $errorDescripcion = "Excede los carácteres.";
                }else{
                    $descripcion = $tmpDescripcion;
                }
            }
        }
    ?>
        
    <div class="container mt-5">
        <h1>Formulario para nuevas categorías de productos</h1>

        <form class="col-6" action="" method="post">

            <!-- Nombre de la categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Nombre de la categoría:</label>
                <input type="text" class="form-control" name="categoria" id="categoria" >
                <?php if (isset($errorCategoria)) echo "<span class='error'>$errorCategoria</span>"; ?>
            </div>

            <!-- Descripción de la categoría -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción de la categoría:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" >
                <?php if (isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>"; ?>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Añadir categoría</button>
                <a href="../index.php" class="btn btn-danger">Volver al index</a>
            </div>
        </form>
    </div>
    <?php
    if(isset($categoria) && isset($descripcion)){
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h1>Se ha añadido esto correctamente a categorías:</h1>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre de la categoría:</strong> <?php echo "$categoria"; ?></li>
                    <li class="list-group-item"><strong>Descripción:</strong> <?php echo "$descripcion"; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php 
    //Añado los datos a la base de datos
        $sql = "INSERT INTO categorias (categoria, descripcion)
            VALUES ('$categoria','$descripcion')";
        $_conexion -> query($sql);
    } 
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>