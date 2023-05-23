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
    }

    function algoritmo(){
        global $_DATA;
        $nombres = array_column($_DATA, 'nombre');
    $edades = array_column($_DATA, 'edad');
    $registros = $_DATA; 

    foreach ($nombres as $nombre) {
        if (!is_string($nombre) || empty(trim($nombre)) || !preg_match('/^[A-Za-z]+$/', $nombre)) {
            $res = "Error, el nombre no puede ser numerico ni contener numeros";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    foreach ($edades as $edad) {
        if (!is_numeric($edad)) {
            $res = "Error: La edad debe ser numerica.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    $maxEdad = max($edades);
    $maxEdadIndex = array_search($maxEdad, $edades);

    $personaMaxEdad = array(
        "Nombre" => $nombres[$maxEdadIndex],
        "Edad" => $maxEdad
    );

    $mensaje = array(
        "Lista de Estudiantes" => $_DATA,
        "Estudiante con Mayor Edad" => $personaMaxEdad,
    );

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }

    
?>
