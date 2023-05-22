<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $nombres = $_DATA["nombre"];
    $notas = $_DATA['notaDef'];
    $mensaje = (array) [
        "mensaje"=> $_DATA,
        "nombre"=> $nombres
    ];



    echo json_encode($mensaje,JSON_PRETTY_PRINT);

?>