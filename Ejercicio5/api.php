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

function algoritmo(){
    global $_DATA;
    if (is_numeric($_DATA["num1"]) && is_numeric($_DATA["num2"])) {
        $num1 = $_DATA["num1"];
        $num2 = $_DATA["num2"];
        $total = $num1 + $num2;
        $producto = $num1 * $num2;
        $menos = $num2 - $num1;
        $division = $num2 / $num1;
    
        if ($num1 > $num2) {
            $mensaje = array(
                "mensaje" => "La Suma es $total y su producto es $producto"
            );
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
        } else {
            $mensaje = array(
                "mensaje" => "La Resta es $menos y su divisions es $division"
            );
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
        }
        try {
            $res = match ($METHOD) {
                "POST" => algoritmo(...$_DATA)
            };
        } catch (\Throwable $th) {
            $res = "Error";
        }
    
    }else{
        echo "Los valores deben ser numericos";
    }
}


?>