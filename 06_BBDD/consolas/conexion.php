<?php
    $_servidor = "127.0.0.1";
    $_usuario = "estudiante";
    $_contrasena = "estudiante";
    $_BBDD = "consolas_bd";

    //Mysqli ó PDO (nosotros vamos a usar Mysqli)
    //Intenta crear una conexion con la base de datos con los siguientes parámetros y en ese orden
    //sino los recibe, muere.
    $_conexion = new Mysqli($_servidor, $_usuario, $_contrasena, $_BBDD)
        or die("Error de conexión");
?>