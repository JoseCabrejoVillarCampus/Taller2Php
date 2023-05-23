<?php
header("Content-Type: application/json; charset:UTF-8");
$_DATA = json_decode(file_get_contents("php://input"), true);
$METHOD = $_SERVER["REQUEST_METHOD"];

try {
    $res = match ($METHOD) {
        "POST" => algoritmo()
    };
} catch (\Throwable $th) {
    $res = "Error";
}
;

function algoritmo()
{
    global $_DATA;
    $nombres = array_column($_DATA, 'nombre');
    $precios = array_column($_DATA, 'precio');
    $cantidades = array_column($_DATA, 'cantidad');
    $registros = $_DATA;

    foreach ($nombres as $nombre) {
        if (!is_string($nombre) || empty(trim($nombre)) || !preg_match('/^[A-Za-z]+$/', $nombre)) {
            $res = "Error, el nombre no puede ser numerico ni contener numeros";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    foreach ($precios as $precio) {
        if (!is_numeric($precio)) {
            $res = "Error: El precio debe ser numeric.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }
    foreach ($cantidades as $cantidad) {
        if (!is_numeric($cantidad)) {
            $res = "Error: La cantidad debe ser numerica.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    $subtotales = array_map(function ($precio, $cantidad) {
        return $precio * $cantidad;
    }, $precios, $cantidades);

    $total = array_sum($subtotales);
    $productosSubtotales = array_combine($nombres, $subtotales);

    return array(
        "Lista de Productos" => $_DATA,
        "Productos" => $productosSubtotales,
        "Total" => $total
    );
}



echo json_encode($res, JSON_PRETTY_PRINT);
?>