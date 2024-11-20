<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>
    <!-- Post puede enviar información privada, mientras que get no -->
    <form action="" method="post">

        <!-- name es como el nombre de la variable, a la que llamaremos más tarde -->
        
        Mensaje:<input type="text" name="mensaje">
        <!-- aqui va otro input -->
        Repetir:<input type="text" name ="mensaje1">
        <input type="submit" value="Enviar">
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $mensaje = $_POST["mensaje"];
        $mensaje1 = $_POST["mensaje1"];
        for($i=0;$i<$mensaje1;$i++){
            
            echo"<h1>$mensaje</h1>";
        }

        //aniadir al formulario un campo de texto adicional para introducir un numero
        //mostrar el mensaje tantas veces como indique el numero
    }
    ?>

</body>
</html>