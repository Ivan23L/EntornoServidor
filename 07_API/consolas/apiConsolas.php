<?php
    header("Content-Type: application/json");
    include("conexionPDO.php");

    $metodo = $_SERVER["REQUEST_METHOD"];
    $entrada = json_decode(file_get_contents('php://input'), true);//Los parametros se mandan por formato Json, se decodifica
    /* Crea un array asociativo según la entrada en el formulario
        $entrada["numero"] -> <input name="numero">
    */

    switch($metodo) {
        case "GET":
            /* echo json_encode(["método" => "get"]); */
            manejarGet($_conexion);
            break;
        case "POST":
            manejarPost($_conexion, $entrada);
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
        $sql = "SELECT * FROM consolas";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO consolas(nombre, fabricante, generacion, unidades_vendidas)
            VALUES (:nombre, :fabricante, :generacion, :unidades_vendidas)";

        $stmt = $_conexion -> prepare ($sql);
        $stmt -> execute([
            "nombre" => $entrada["nombre"],
            "fabricante" => $entrada["fabricante"],
            "generacion" => $entrada["generacion"],
            "unidades_vendidas" =>["unidades_vendidas"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "la consola se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al insertar la consola"]);
        }
    }
?>