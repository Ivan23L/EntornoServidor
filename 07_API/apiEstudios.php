<?php
    header("Content-Type: application/json");
    include("conexionPDO.php");

    $metodo = $_SERVER["REQUEST_METHOD"];

    switch($metodo) {
        case "GET":
            /* echo json_encode(["método" => "get"]); */
            manejarGet($_conexion);
            break;
        case "POST":
            echo json_encode(["método" => "post"]);
            break;
        case "PUT":
            echo json_encode(["método" => "put"]);
            break;
        case "DELETE":
            echo json_encode(["método" => "delete"]);
            break;
        default:
        echo json_encode(["método" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        $sql = "SELECT * FROM estudios";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    }
?>