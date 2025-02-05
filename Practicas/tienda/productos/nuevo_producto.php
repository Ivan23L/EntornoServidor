<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para nuevos productos</title>
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
            header("location: ../usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
    
    <?php
        // Validación de formulario cuando se envía
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Validar nombre
            $tmpNombre = depurar(ucwords(strtolower($_POST['nombre'])));
            if ($tmpNombre == ''){
                $errorNombre = "Es obligatorio.";
            }else{
                if(strlen($tmpNombre)< 2){
                    $errorNombre = "Debe tener mínimo 2 carácteres.";
                }else{
                    $patron = "/^[a-zA-Z 0-9]+$/";
                    if(!preg_match($patron, $tmpNombre)){
                        $errorNombre = "Solo puede tener letras, números y espacios.";
                    }else{
                        $nombre = $tmpNombre;
                    }
                }
            }

            // Validar precio
            $tmpPrecio = depurar(ucwords(strtolower($_POST['precio'])));
            if ($tmpPrecio == ''){
                $errorPrecio = "Es obligatorio.";
            }else{
                if(!is_numeric($tmpPrecio)){
                    $errorPrecio = "Debe ser un número.";
                }else{
                    if(($tmpPrecio < 0)){
                        $errorPrecio = "No puede ser menor a 0.";
                        
                    }else{
                        $patron = "/^[0-9]{1,4}(\.[0-9]{1,2})?+$/";
                        if(!preg_match($patron, $tmpPrecio)){
                            $errorPrecio = "Debe tener decimales";
                        }else{
                            $precio = $tmpPrecio;
                        }
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

            // Validar categoría seleccionada
            $tmpCategoria = depurar(ucwords(strtolower($_POST['categoria'])));
            if ($tmpCategoria == '') {
                $errorCategoria = "La categoría es obligatoria. Escoge una.";
            }else{
                $categoria = $tmpCategoria;
            }

            // Validar stock
            $tmpStock = depurar(ucwords(strtolower($_POST['stock'])));
            if ($tmpStock == ''){
                $stock = 0;
            }else{
                $stock = $tmpStock;
            }

            //$_FILES es un array BIDIMENSIONAL, mientras que $_POST es un array UNIDIMENSIONAL
            $imagen = $_FILES["imagen"]["name"];
            $ubicacionTemporal = $_FILES["imagen"]["tmp_name"];
            $ubicacionFinal = "../util/imagenes/$imagen";
            $imagenTipo = $_FILES["imagen"]["type"];

            //Necesita tener permisos
            //mueve el archivo que se ha cargado de una ubicación a otra
            move_uploaded_file($ubicacionTemporal, $ubicacionFinal);

            //Si todo está correcto añado los datos a la base de datos
            if(isset($nombre) && isset($precio) && isset($descripcion) && isset($categoria) && isset($stock) && isset($ubicacionFinal)){
                
                $sql = "INSERT INTO productos (nombre, precio, categoria, stock, imagen, descripcion)
                    VALUES ('$nombre','$precio','$categoria','$stock', '$ubicacionFinal', '$descripcion')";
                $_conexion -> query($sql);
                ?>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header text-center bg-primary text-white">
                                <h1>Se ha añadido esto correctamente a productos:</h1>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Nombre del producto:</strong> <?php echo "$nombre"; ?></li>
                                    <li class="list-group-item"><strong>Precio del producto:</strong> <?php echo "$precio"; ?></li>
                                    <li class="list-group-item"><strong>Descripción:</strong> <?php echo "$descripcion"; ?></li>
                                    <li class="list-group-item"><strong>Categoría del producto:</strong> <?php echo "$categoria"; ?></li>
                                    <li class="list-group-item"><strong>Stock del producto:</strong> <?php echo "$stock"; ?></li>
                                    <li class="list-group-item"><strong>Imagen:</strong> <?php echo "$ubicacionFinal"; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
        $sql = "SELECT categoria FROM categorias";
        $resultado = $_conexion -> query($sql);
        $categoriasDisponibles = [];
        /* fetch_assoc() devuelve una fila de resultados como un array asociativo. Esto significa que podrás acceder
        a cada columna de la fila por su nombre */
        while($fila = $resultado -> fetch_assoc()){
            array_push($categoriasDisponibles, $fila["categoria"]);
        }
    ?>
        
    <div class="container mt-5">
        <h1>Formulario para nuevos productos</h1>
        <!-- enctype="multipart/form-data" para que el formulario pueda leer imagenes -->
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <!-- Título del anime -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" >
                <?php if (isset($errorNombre)) echo "<span class='error'>$errorNombre</span>"; ?>
            </div>

            <!-- Precio del producto -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio del producto:</label>
                <input type="text" class="form-control" name="precio" id="precio" >
                <?php if (isset($errorPrecio)) echo "<span class='error'>$errorPrecio</span>"; ?>
            </div>

            <!-- Descripción del producto -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del producto:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" >
                <?php if (isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>"; ?>
            </div>
            
            <!-- Categoría del producto -->
            <div class="mb-3">
                <select id="categoria" name="categoria" class="form-select form-select-lg">
                    <option value="">---Selecciona una categoría---</option>
                    <?php
                    foreach ($categoriasDisponibles as $categorias): ?>
                        <option value="<?php echo $categorias;?>"><?= $categorias ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errorCategoria)) echo "<span class='error'>$errorCategoria</span>"; ?>
            </div>

            <!-- Stock del producto -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock del producto:</label>
                <input type="text" class="form-control" name="stock" id="stock" >
                <?php if (isset($errorStock)) echo "<span class='error'>$errorStock</span>"; ?>
            </div>

            <!-- Campo para añadir imagen al producto -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" >
                <?php if (isset($errorImagen)) echo "<span class='error'>$errorImagen</span>"; ?>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Añadir producto</button>
                <a href="../index.php" class="btn btn-success">Volver al index</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>