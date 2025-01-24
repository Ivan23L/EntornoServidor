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
        case "PUT"://UPDATE
            manejarPut($_conexion, $entrada);
            break;
        case "DELETE":
            manejarDelete($_conexion, $entrada);
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

    function manejarGetParametros() {

        global $_conexion;
    
        // Si filtramos por un parametro en concreto filtramos por ese parametro
        if (isset($_GET["ciudad"]) && isset($_GET["anno_fundacion"])) {
            $sql = "SELECT * FROM estudios WHERE 
            ciudad = :ciudad,
            anno_fundacion = :anno_fundacion";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "ciudad" => $_GET["ciudad"],
                "anno_fundacion" => $_GET["anno_fundacion"]
            ]);
        } elseif (isset($_GET["anno_fundacion"])) {
            $sql = "SELECT * FROM estudios WHERE anno_fundacion = :anno_fundacion";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "anno_fundacion" => $_GET["anno_fundacion"]
            ]);
        } elseif (isset($_GET["ciudad"])) {
            $sql = "SELECT * FROM estudios WHERE ciudad = :ciudad";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "ciudad" => $_GET["ciudad"]
            ]);
        } else {
            // Si no tiene ningún parametro muestra todo o ningun where.
            $sql = "SELECT * FROM estudios";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute();
        }
        /* 
            Si tenemos varios parametros pondremos varios if, si tenemos más de 3 o 4 tendremos
            que hacer una inyección dinamica de sql 
        */
    
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO estudios(nombre_estudio, ciudad, anno_fundacion)
            VALUES (:nombre_estudio, :ciudad, :anno_fundacion)";

        $stmt = $_conexion -> prepare ($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"],
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el estudio se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al insertar el estudio"]);
        }
    }
    
    function manejarPut($_conexion, $entrada) {
        $sql = "UPDATE estudios SET
            ciudad = :ciudad,
            anno_fundacion = :anno_fundacion
            WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"],
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);
        if($stmt) {
            echo json_encode(["mensaje" => "el estudio se ha modificado"]);
        } else {
            echo json_encode(["mensaje" => "error al modificar el estudio"]);
        }
    }

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM estudios WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el estudio se ha borrado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al borrar el estudio"]);
        }
    }
?>