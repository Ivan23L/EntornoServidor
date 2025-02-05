<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para editar la categoria</title>
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
            //CUIDADO AMIGO esta función es peligrosa, tiene que ejecutarse antes de que
            //se ejecute el código body
            header("location: ../usuario/iniciar_sesion.php");
            exit;
        } 
    ?>
</head>
<body>
    
    <?php
        $categoriaSeleccionada = $_GET["categoria"];

        $sql = "SELECT * FROM categorias WHERE categoria = '$categoriaSeleccionada'";
        $resultado = $_conexion ->query($sql);

        //Guardo en variables mías las columnas de mi base de datos
        while($fila = $resultado -> fetch_assoc()){
            $categoria = $fila["categoria"];
            $descripcion = $fila["descripcion"];
        }

        //Cuando se pulsa el botón de editar se recogen estos datos de NUESTRO formulario en las variables para posteriormente modificarlos
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmpDescripcion = depurar($_POST["descripcion"]);

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
                $descripcion = $tmpDescripcion;
            }
            //Aquí es donde estoy editando la base de datos con las variables que han recogido los datos del formulario
            $sql = "UPDATE categorias SET
                descripcion = '$descripcion'
                    WHERE categoria = '$categoriaSeleccionada'
            ";
            $_conexion -> query($sql);
        }
    ?>
        
    <div class="container mt-5">
        <h1>Aquí puedes editar la categoría</h1>
        <form class="col-6" action="" method="post">
            
            <!-- Categoría -->
            <div class="mb-3">
                <label for="categoría" class="form-label">Categoría:</label>
                <input type="text" class="form-control" name="categoría" disabled value="<?php echo $categoria?>">
                <input type="hidden" name="categoria" value="<?php echo $categoria; ?>">
                <?php if (isset($errorCategoria)) echo "<span class='error'>$errorCategoria</span>"; ?>
            </div>

            <!-- Descripción de la categoría -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion">
                <?php if (isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>"; ?>
            </div>

            <div class="mb-3">
                <input type="hidden" name="categoria" value="<?php echo $categoria?>">
                <button type="submit" class="btn btn-primary">Editar categoría</button>
                <a href="../index.php" class="btn btn-danger">Volver a la tienda</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>