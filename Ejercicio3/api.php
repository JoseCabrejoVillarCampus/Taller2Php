<?php

header("Content-Type: application/json; charset:UTF-8");
$_DATA = json_decode(file_get_contents("php://input"), true);
$METHOD = $_SERVER["REQUEST_METHOD"];

$rest = $_DATA["rest"];
$amp = $_DATA["amp"];
function algoritmo(float $rest, float $amp)
{
    $voltaje = $rest * $amp;
    return $voltaje;
}

$voltaje = algoritmo($rest, $amp);
$mensaje = (array) [
    "voltaje" => $voltaje." voltios"
];

echo json_encode($mensaje, JSON_PRETTY_PRINT);

?>