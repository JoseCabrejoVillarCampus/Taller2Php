<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    if(is_numeric($_DATA['arista'])&& is_numeric($_DATA['altura'])&& is_numeric($_DATA['base'])){

    $aristas = $_DATA ['arista'];
    $altura = $_DATA ['altura'];
    $base= $_DATA ['base'];

    function perimetro (float $aristas){
        $perimetro= $aristas*4;
        return $perimetro;
    };
    function area(float $altura, float $base){
        $area = $altura*$base;
        return $area;
    } 

    try {
        $res = match ($METHOD) {
            "POST" => perimetro(...$_DATA),
        };
    } catch (\Throwable $th) {
        $res = "Error";
    }

    $mensaje = array(
        "Informacio" => $_DATA,
        "Perimetro del Cuadrado es:" => $perimetro,
        "Altura del Rectangulo es:" => $area
    );

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }else{
        echo "Los Valores Deben Ser Numericos";
    }

?>