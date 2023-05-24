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
        $numeros = array_column($_DATA, 'num');
    $registros = $_DATA;

    if (in_array(0, $numeros)) {
        $res = "Has Salido";
        echo json_encode($res, JSON_PRETTY_PRINT);
        exit;
    }

    foreach ($numeros as $numero) {
        if (!is_numeric($numero)) {
            $res = "Error: Los valores deben ser numéricos.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    $total = array_sum($numeros);
    $conteo = count($numeros);
    $promedio = $total / $conteo;
    $maxVal = max($numeros);
    $minVal = min($numeros);

    $mensaje = array(
        "Numeros Digitados" => $_DATA,
        "Suma Total" => $total,
        "Numero de Datos Ingresados" => $conteo,
        "Promedio Total" => $promedio,
        "El Numero Con Mayor Valor Es:" => $maxVal,
        "El Numero Con Menor Valor Es:" => $minVal,
    );

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }

    
?>
