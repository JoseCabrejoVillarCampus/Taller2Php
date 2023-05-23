<?php
    
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    function validacion($num){
        return ($num % 2 === 0) ? "Par" : "Impar";
    }
    $num = $_DATA["num"];
    
    $mensaje = (array) [
        "mensaje"=> validacion($num),
        "numero"=> $_DATA,
    ];

    echo json_encode($mensaje,JSON_PRETTY_PRINT);

?>