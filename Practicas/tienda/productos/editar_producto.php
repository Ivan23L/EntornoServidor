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
        $idProducto = $_GET["id_producto"];

        $sql = "SELECT * FROM productos WHERE id_producto = $idProducto";
        $resultado = $_conexion ->query($sql);

        //Guardo en variables mías las columnas de mi base de datos
        while($fila = $resultado -> fetch_assoc()){
            $nombre = $fila["nombre"];
            $precio = $fila["precio"];
            $categoria = $fila["categoria"];
            $stock = $fila["stock"];
            $descripcion = $fila["descripcion"];
        }

        //Cuando se pulsa el botón de editar se recogen estos datos de NUESTRO formulario en las variables para posteriormente modificarlos
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $idProducto = $_POST["id_producto"];
            $nombre = depurar($_POST["nombre"]);
            $precio = depurar($_POST["precio"]);
            $descripcion = depurar($_POST["descripcion"]);
            $categoria = $_POST["categoria"];
            $stock = $_POST["stock"];
            //$imagen = $_POST["imagen"];
            
            //Aquí es donde estoy editando la base de datos con las variables que han recogido los datos del formulario
            $sql = "UPDATE productos SET
                nombre = '$nombre',
                precio = $precio,
                categoria = '$categoria',
                descripcion = '$descripcion',
                stock = $stock
                    WHERE id_producto = $idProducto
            ";
            $_conexion -> query($sql);
        }
    ?>
        
    <div class="container mt-5">
        <h1>Aquí puedes editar los productos</h1>
        <form class="col-6" action="" method="post">
            
            <!-- Nombre del producto -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>">
                <?php if (isset($errorNombre)) echo "<span class='error'>$errorNombre</span>"; ?>
            </div>

            <!-- Precio del producto -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio del producto:</label>
                <input type="text" class="form-control" name="precio" value="<?php echo $precio?>">
                <?php if (isset($errorPrecio)) echo "<span class='error'>$errorPrecio</span>"; ?>
            </div>

            <!-- Descripción del producto -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del producto:</label>
                <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion?>">
                <?php if (isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>"; ?>
            </div>

            <!-- Categoría del producto -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría del producto:</label>
                <input type="text" class="form-control" name="categoria" value="<?php echo $categoria?>">
                <?php if (isset($errorCategoria)) echo "<span class='error'>$errorCategoria</span>"; ?>
            </div>

            <!-- Stock del producto -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock del producto:</label>
                <input type="text" class="form-control" name="stock" value="<?php echo $stock?>">
                <?php if (isset($errorStock)) echo "<span class='error'>$errorStock</span>"; ?>
            </div>

            <div class="mb-3">
                <input type="hidden" name="id_producto" value="<?php echo $idProducto?>">
                <button type="submit" class="btn btn-primary">Editar producto</button>
                <a href="../index.php" class="btn btn-danger">Volver a la tienda</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>