<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    try {
        $res = match($METHOD){
            "POST" => algoritmo(...$_DATA)
        };
    } catch (\Throwable $th) {
        $res = "Error";
    };

    function algoritmo(){
        global $_DATA;
        $nombres = array_column($_DATA, 'nombre');
    $marcas = array_column($_DATA, 'marca');
    $registros = $_DATA; // Obtener los registros enviados desde el formulario

    foreach ($nombres as $nombre) {
        if (!is_string($nombre) || empty(trim($nombre)) || !preg_match('/^[A-Za-z]+$/', $nombre)) {
            $res = "Error, el nombre no puede ser numerico ni contener numeros";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    };

    foreach ($marcas as $marca) {
        if (!is_numeric($marca)) {
            $res = "Error: La Marca debe ser numerica.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    };

    $maxMarca = max($marcas);
    $maxMarcaIndex = array_search($maxMarca, $marcas);

    $personaMaxMarca = array(
        "nombre" => $nombres[$maxMarcaIndex],
        "marca" => $maxMarca
    );

    $mensaje = array(
        "Lista de Atletas" => $_DATA,
        "Atleta Con La Mayor Marca" => $personaMaxMarca,
    );
    if ($maxMarca > 15.50) {
        $mensaje["¡Felicidades!"] = "¡Lo has Conseguido! Has ganado un 500 Milones por romper el record.";
    };
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
    };
?>
