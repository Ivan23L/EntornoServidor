<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salario</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h3>Salario Neto</h3>
    <br>
    <!-- Calcular con el salario bruto el neto -->

    <form action="" method="post">
        <label for="brute">Salario bruto:</label> 
        <input type="text" name="brute" id="brute">
        <br><br>
        <input type="submit" value="Convertir">
    </form>

    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sueldoBruto = $_POST["brute"];
        $sueldoNeto = 0;
        $tramo1 = (12450 * 0.19);
        $tramo2 = ((20200 - 12450) * 0.24);
        $tramo3 = ((35200 - 20200) * 0.30);
        $tramo4 = ((60000 - 35200) * 0.37);
        $tramo5 = ((300000 - 60000) * 0.47);
        echo $tramo1 . "<br>";
        echo $tramo2 . "<br>";
        echo $tramo3 . "<br>";
        echo $tramo4 . "<br>";
        echo $tramo5 . "<br>";
        echo "<p>Tu sueldo neto es: $sueldoNeto </p>";
    }
    ?>
    <br>
    

</body>
</html>