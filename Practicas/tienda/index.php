<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        require ('util/conexion.php');
        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenid@ ".$_SESSION["usuario"]."</h2>";
        }
    ?>
</head>
<body>
    <div class="container mt-5">
        <h1>Tabla de productos</h1>
        <?php
            $sql = "SELECT * FROM productos";
            $resultado = $_conexion -> query($sql);
        ?>
        <a href="productos/index.php" class="btn btn-primary">Productos</a>
        <a href="categorias/index.php" class="btn btn-primary">Categorias</a>
        <?php
            if(isset($_SESSION["usuario"])){
                ?><a class="btn btn-danger" href="usuario/cerrar_sesion.php">Cerrar sesión</a><?php
                ?><a class="btn btn-warning" href="usuario/cambiar_credenciales.php">Cambiar contraseña</a><?php
            }else{
                ?><a href="usuario/registro.php" class="btn btn-warning">Registrate</a><?php
                ?><a href="usuario/iniciar_sesion.php" class="btn btn-warning">Inicia Sesión</a><?php
            }
        ?>
        
        <table class = "table table-bordered table-light table-hover border-secondary text-center">
            <thead class=" table-danger">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Trata el objeto resultado como si fuera un array asociativo, y mientras haya filas, 
                    //fetch_assoc() los guardará ahora sí en un array 
                    while($fila = $resultado -> fetch_assoc()){
                        //Cada valor que devuleve tiene dos claves, tanto el nombre de la columna, como el valor que le corresponde a la columna
                        echo"<tr>";
                        echo "<td class='table-warning'>" . $fila["nombre"] . "</td>";
                        echo "<td class='table-success'>" . $fila["precio"] . "</td>";
                        echo "<td class='table-success'>" . $fila["descripcion"] . "</td>";
                        echo "<td class='table-success'>" . $fila["categoria"] . "</td>";
                        echo "<td class='table-info'>" . $fila["stock"] . "</td>";
                        ?>
                        <td class='table-info'>
                            <img width="100" height="150" src="<?php echo $fila["imagen"]?>">
                        </td>
                        <?php
                        echo"</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>