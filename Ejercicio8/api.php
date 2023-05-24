<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    if (is_numeric($_DATA['arista']) && is_numeric($_DATA['altura']) && is_numeric($_DATA['base'])) {
        $arista = $_DATA['arista'];
        $altura = $_DATA['altura'];
        $base = $_DATA['base'];

        function perimetro(float $arista)
        {
            $perimetro = $arista * 4;
            return $perimetro;
        }

        function area(float $altura, float $base)
        {
            $area = $altura * $base;
            return $area;
        }

        try {
            $res = match ($METHOD) {
                "POST" => [
                    "Perimetro del Cuadrado es:" => perimetro($arista),
                    "Altura del Rectangulo es:" => area($altura, $base),
                ],
            };
        } catch (\Throwable $th) {
            $res = "Error";
        }

        $solicitado = array(
            "Informacion" => $_DATA,
            "Resultado" => $res,
        );

        echo json_encode($solicitado, JSON_PRETTY_PRINT);
    } else {
        echo "Los Valores Deben Ser Numericos";
    }
?>