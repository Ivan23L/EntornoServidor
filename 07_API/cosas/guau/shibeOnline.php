<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotos de Shiba Inu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
    // Comprobamos si el formulario se ha enviado y si el número de fotos es válido
    if (isset($_GET["cantidad"]) && is_numeric($_GET["cantidad"])) {
        $cantidad = $_GET["cantidad"];
        // Aseguramos que la cantidad esté entre 1 y 10
        if ($cantidad < 1 || $cantidad > 10) {
            $cantidad = 5;  // Si el número es inválido, mostramos 5 fotos por defecto
        }
    }
    //URL ESTAFADORES NO FUNCIONA
    $apiUrl = "https://shibe.online/api/";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($curl);
    
    // Verificar si hubo un error en la solicitud cURL
    if(curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        $fotos = json_decode($respuesta, true);
    }
    
    curl_close($curl);
    ?>
    <div class="container mt-5">
        <h1>Selecciona el número de fotos de Shiba Inu</h1>
        <form action="" method="get">
            <div class="mb-3">
                <label for="cantidad" class="form-label">Número de fotos:</label>
                <select name="cantidad" id="cantidad" class="form-select">
                    <!-- Generamos las opciones del 1 al 10 -->
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php if (isset($cantidad) && $cantidad == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ver fotos</button>
        </form>

        <?php if (isset($fotos) && is_array($fotos)): ?>
            <div class="mt-4">
                <h2>Fotos de Shiba Inu</h2>
                <div class="row">
                    <?php foreach ($fotos as $foto): ?>
                        <div class="col-md-4 mb-3">
                            <img src="<?php echo htmlspecialchars($foto); ?>" alt="Shiba Inu" class="img-fluid">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php elseif (isset($fotos)): ?>
            <div class="mt-4">
                <p>No se pudieron cargar las fotos. Inténtalo de nuevo más tarde.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
