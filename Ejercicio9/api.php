<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $nombres = array_column($_DATA, 'nombre');
    $marcas = array_column($_DATA, 'marca');
    $registros = $_DATA; // Obtener los registros enviados desde el formulario


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
    }

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>
