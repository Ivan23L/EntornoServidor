<?php
    session_start();
    session_destroy();
    header("location: inicioSesion.php");
    exit;   //cierra el fichero y lo mata
?>