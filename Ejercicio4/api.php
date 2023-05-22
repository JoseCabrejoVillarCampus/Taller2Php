<?php

header("Content-Type: application/json; charset:UTF-8");
$_DATA = json_decode(file_get_contents("php://input"), true);
$METHOD = $_SERVER["REQUEST_METHOD"];

$nombre1 = $_DATA["nombre1"];
$edad1 = $_DATA["edad1"];
$nombre2 = $_DATA["nombre2"];
$edad2 = $_DATA["edad2"];
$nombre3 = $_DATA["nombre3"];
$edad3 = $_DATA["edad3"];
$elemento1= array($nombre1=>$edad1);
$elemento2= array($nombre2=>$edad2);
$elemento3= array($nombre3=>$edad3);
$datosFusionados = array_merge($elemento1, $elemento2, $elemento3);
$personaMas="";
$edadMas=0;

foreach($datosFusionados as $nombre => $edad){
    if($edad > $edadMas){
        $personaMas = $nombre;
        $edadMas = $edad;
    }
}

$mensaje = array(
    "mensaje" => "La persona mayor es $personaMas con $edadMas anos.",
    "notas" => $_DATA
);

echo json_encode($mensaje, JSON_PRETTY_PRINT);

?>
