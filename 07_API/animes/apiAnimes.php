<?php
    header("Content-Type: application/json");
    include("conexionPDO.php");

    $metodo = $_SERVER["REQUEST_METHOD"];
    $entrada = json_decode(file_get_contents('php://input'), true);//Los parametros se mandan por formato Json, se decodifica
    /* Crea un array asociativo según la entrada en el formulario
        $entrada["numero"] -> <input name="numero">
    */
    //HAY QUE INGRESAR A ESTA PÁGINA DESDE EL NAVEGADOR URL

    switch($metodo) {
        case "GET":
            /* echo json_encode(["método" => "get"]); */
            manejarGet($_conexion);
            break;
        case "POST":
            manejarPost($_conexion, $entrada);
            break;
        case "DELETE":
            manejarDelete($_conexion, $entrada);
            break;
        case "PUT":
            manejarPut($_conexion, $entrada);
            break;
    }

    function manejarGet($_conexion){
        $sql = "SELECT * FROM estudios";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO animes(titulo, nombre_estudio, anno_estreno, num_temporadas)
            VALUES (:titulo, :nombre_estudio, :anno_estreno, :num_temporadas)";

        $stmt = $_conexion -> prepare ($sql);
        $stmt -> execute([
            "titulo" => $entrada["titulo"],
            "nombre_estudio" => $entrada["nombre_estudio"],
            "anno_estreno" => $entrada["anno_estreno"],
            "num_temporadas" => $entrada["num_temporadas"] 
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el anime se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al insertar el anime"]);
        }
    }

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM estudios WHERE titulo = :titulo";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "titulo" => $entrada["titulo"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el anime se ha borrado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al borrar el anime"]);
        }
    }

    function manejarPut($_conexion, $entrada) {
        $sql = "UPDATE estudios SET
            titulo = :titulo,
            anno_estreno = :anno_estreno,
            num_temporadas = :num_temporadas
            WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "titulo" => $entrada["titulo"],
            "nombre_estudio" => $entrada["nombre_estudio"],
            "anno_estreno" => $entrada["anno_estreno"],
            "num_temporadas" => $entrada["num_temporadas"] 
        ]);
        if($stmt) {
            echo json_encode(["mensaje" => "el estudio se ha modificado"]);
        } else {
            echo json_encode(["mensaje" => "error al modificar el estudio"]);
        }
    }
?>