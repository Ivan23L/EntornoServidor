<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Array</title>
    <link rel="stylesheet" type="text/css" href="./estilos.css">
</head>
<body>

    <!-- RECORDATORIO!!!! EL VIERNES VEMOS CÓMO ORDENAR TABLAS -->
    <!-- EJERCICIO 1
        
    Desarrollo web en entorno servidor => Alejandra
    Desarrollo web en entorno cliente => José Miguel
    Diseño de interfaces web => José Miguel
    Despligue de aplicaciones web => Jaime
    Empresa e iniciativa emprendedora => Andrea
    Inglés => Virginia

    MOSTRARLO TODO EN UNA TABLA
    
    -->

    <?php
    $Asignaturas = [
        "Desarrollo web en entorno servidor" => "Alejandra",
        "Desarrollo web en entorno cliente" => "José Miguel",
        "Diseño de interfaces web" => "José Miguel",
        "Despliegue de aplicaciones web" => "Jaime",
        "Empresa e iniciativa emprendedora" => "Andrea",
        "Inglés" => "Virginia"
    ];
    ?>
    <table>
        <caption><h1>Asignaturas</h1></caption>
        <thead>
            <tr>
                <th>Asignatura</th>
                <th>Profesor</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            foreach($Asignaturas as $Asignatura => $profesor){?>

            <tr>
                <td><?php echo $Asignatura ?></td>
                <td><?php echo $profesor ?></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>

    <p>--------------------------------------------</p>

    <!-- EJERCICIO 2
    Francisco => 3
    Daniel => 5
    Aurora => 10
    Luis => 7
    Samuel => 9
    MOSTRAR EN UNA TABLA CON 3 COLUMNAS 
    -   C1:ALUMNO
    -   C2:NOTA
    -   C3:SI NOTA < 5, SUSPENSO, ELSE, APROBADO
    -->

    <?php
    $Xivatos = [
        "Francisco" => 3,
        "Daniel" => 5,
        "Aurora" => 10,
        "Luis" => 7,
        "Samuel" => 9,
    ];
    ?>
    <?php
    $Xivatos["Agustín"] = rand(0,10);
    $Xivatos["Waluis"] = rand(0,10);
    unset($Xivatos["Vicente"]);
    ksort($Xivatos);
    ?>

    <table>
        <caption><h1>Xivatos</h1></caption>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nota</th>
                <th>Aprueba</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            foreach($Xivatos as $nombre => $nota){
                if($nota < 5){
                    $aprueba = "SUSPENSO";
                    echo "<tr class='suspenso'>";
                }else{
                    $aprueba = "APROBADO";
                    echo "<tr class='aprobado'>";
                }    
                
            ?>
                <td><?php echo $nombre ?></td>
                <td><?php echo $nota ?></td>
                <td><?php echo $aprueba ?></td>
            </tr>
            
            <?php } ?>

        </tbody>
    </table>
    



</body>
</html>