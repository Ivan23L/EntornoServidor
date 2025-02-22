<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        require ('../util/conexion.php');
        require ('../util/depurar.php');

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
    <div class="container mt-5">
        <h1>Tabla de categorías</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $categoria = $_POST["categoria"];
                //borrar la categoría (NO SE PUEDE SI ESTA TIENE ALGÚN PRODUCTO RELACIONADO)
                $sql = "DELETE FROM categorias WHERE categoria = '$categoria'";
                $resultado = $_conexion -> query($sql);
            }

            $sql = "SELECT * FROM categorias";
            $resultado = $_conexion -> query($sql);
            
        ?>
        <a href="./nueva_categoria.php" class="btn btn-primary">Crea una categoría</a>
        <a class="btn btn-success" href="../index.php">Volver a la tienda</a>
        <a class="btn btn-danger" href="../usuario/cerrar_sesion.php">Cerrar sesión</a>
        <table class = "table table-bordered table-light table-hover border-secondary text-center">
            <thead class=" table-danger">
                <tr>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Trata el objeto resultado como si fuera un array asociativo, y mientras haya filas, 
                    //fetch_assoc() los guardará ahora sí en un array 
                    while($fila = $resultado -> fetch_assoc()){
                        //Cada valor que devuleve tiene dos claves, tanto el nombre de la columna, como el valor que le corresponde a la columna
                        echo"<tr>";
                        echo "<td class='table-warning'>" . $fila["categoria"] . "</td>";
                        echo "<td class='table-success'>" . $fila["descripcion"] . "</td>";
                        ?>
                        <td class='table-secondary'>
                            <a class="btn btn-primary" 
                            href="editar_categoria.php?categoria=<?php echo $fila["categoria"]?>">Editar categoría</a>
                        </td>
                        <td class='table-light'>
                            <form action="" method="post">
                                <!-- Hago que sea dinámico, cada categoría es única -->
                                <input type="hidden" name="categoria" value="<?php echo $fila["categoria"]?>">
                                <input type="submit" value="Borrar" class="btn btn-danger">
                            </form>
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