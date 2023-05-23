<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $num = array_column($_DATA, 'num');
    $registros = $_DATA;
    $total= array_sum($num);
    $conteo=count($num);
    $promedio=$total/$conteo;
    $maxVal= max($num);
    $minVal= min($num);


    $mensaje = array(
        "Numeros Digitados" => $_DATA,
        "Suma Total"=>$total,
        "Numero de Datos Ingresados"=>$conteo,
        "Promedio Total"=>$promedio,
        "El Numero Con Mayor Valor Es:"=>$maxVal,
        "El Numero Con Menor Valor Es:"=>$minVal,

    );
    
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>
