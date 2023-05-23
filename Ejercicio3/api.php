<?php

header("Content-Type: application/json; charset:UTF-8");
$_DATA = json_decode(file_get_contents("php://input"), true);
$METHOD = $_SERVER["REQUEST_METHOD"];
if (is_numeric($_DATA["rest"]) && is_numeric($_DATA["amp"])) {
    $rest = $_DATA["rest"];
    $amp = $_DATA["amp"];
    function algoritmo(float $rest, float $amp)
    {
        $voltaje = $rest * $amp;
        return $voltaje;
    }

    $voltaje = algoritmo($rest, $amp);

    try {
        $res = match ($METHOD) {
            "POST" => algoritmo(...$_DATA)
        };
    } catch (\Throwable $th) {
        $res = "Error";
    }
    $mensaje = (array) [
        "voltaje" => $voltaje . " voltios"
    ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
} else {
    echo "Deben estar los valores y deben ser numericos";
};


?>