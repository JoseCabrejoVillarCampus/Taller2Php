<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $nombres = array_column($_DATA, 'nombre');
    $precios = array_column($_DATA, 'precio');
    $cantidades= array_column($_DATA, 'cantidad');
    $registros = $_DATA;

    $subtotales = array_map(function ($precio, $cantidad) {
        return $precio * $cantidad;
    }, $precios, $cantidades);

    $total = array_sum($subtotales);
    $productosSubtotales = array_combine($nombres, $subtotales);

    $mensaje = array(
        "Lista de Productos" => $_DATA,
        "Productos" => $productosSubtotales,
        "Total" => $total
    );

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>