<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $aristas = $_DATA ['arista'];
    $altura = $_DATA ['altura'];
    $base= $_DATA ['base'];

    $perimetro = $aristas*4;
    $area = $altura*$base;

    $mensaje = array(
        "Informacio" => $_DATA,
        "Perimetro del Cuadrado es:" => $perimetro,
        "Altura del Rectangulo es:" => $area
    );

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>