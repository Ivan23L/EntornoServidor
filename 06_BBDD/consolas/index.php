<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);

        require ('conexion.php');
    ?>
</head>
<body>

    </div>
    <h1>Tabla de consolas</h1>
    <?php
        $sql = "SELECT * FROM consolas";
        
        /*
        Aplicamos la función query(es una consulta) a la conexión(es un objeto), donde se ejecuta la sentencia SQL hecha
        El resultado se almacena en $resultado, que es un objeto con una estructura parecida a los arrays
        */
        //En esta linea se indica que sobre el objeto $_conexion se ejecuta la función query() y se guarda en la variable $resultado

        $resultado = $_conexion -> query($sql);
    ?>
    <table class = "table table-bordered table-light table-hover border-secondary text-center">
        <thead class=" table-danger">
            <tr>
                <th>ID consola</th>
                <th>Nombre</th>
                <th>Fabricante</th>
                <th>Generación</th>
                <th>Unidades Vendidas</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //Trata el objeto resultado como si fuera un array asociativo, y mientras haya filas fetch_assoc() 
                //los guardará ahora sí en un array 
                while($fila = $resultado -> fetch_assoc()){
                    //Cada valor que devuleve tiene dos claves, tanto el nombre de la columna, como el valor que le corresponde a la columna
                    echo"<tr>";
                    echo "<td class='table-warning'>" . $fila["id_consola"] . "</td>";
                    echo "<td class='table-success'>" . $fila["nombre"] . "</td>";
                    echo "<td class='table-info'>" . $fila["fabricante"] . "</td>";
                    echo "<td class='table-info'>" . $fila["generacion"] . "</td>";
                    //null == '' ES VERDADERO (quiere decir que si es null)
                    //null === '' ES FALSO (quiere decir que no es null)
                    if($fila["unidades_vendidas"] === NULL){
                        echo"<td class='table-info'>No hay ventas</td>";
                    }else{
                        echo "<td class='table-info'>" . $fila["unidades_vendidas"] . "</td>";
                    }
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>