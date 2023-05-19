<?php
    // Construir el algoritmo para un programa que ingrese tres
    // notas de un alumno, si el promedio es menor o igual a 3.9
    // mostrar un mensaje "Estudie“, de lo contrario un mensaje que
    // diga "becado"
    // header("Content-Type: application/json; charset:UTF-8");
    // $_DATA = json_decode(file_get_contents("php://input"), true);
    // $METHOD = $_SERVER["REQUEST_METHOD"];
    // switch ($METHOD) {
    //     case 'POST':
    //         $suma = (float) 0;
    //         foreach ($_DATA as $key => $value) {
    //             if(!is_numeric($value)){
    //                 $suma=0;
    //                 break;
    //             }else{
    //                 $suma += $value;
    //             }
    //         }
    //         $promedio = (float) $suma/count($_DATA);
    //         $res = (array) [
    //             "mensaje"=> ($promedio<=3.9) ? "Estudie" : "becado",
    //             "notas"=> $_DATA,
    //             "promedio"=> $promedio
    //         ];
    //         echo json_encode($res,JSON_PRETTY_PRINT);
    //         break;

    //     default:

    //         break;
    // }
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    function validacion($arg){
        return ($arg<=3.9) ? "Estudie" : "becado";
    }
    function algoritmo(float $nota, float $nota2, float $nota3){
        $promedio = ($nota+$nota2+$nota3)/3;
        return validacion($promedio);
    }
    try {
        $res = match($METHOD){
            "POST" => algoritmo(...$_DATA)
        };
    } catch (\Throwable $th) {
        $res = "Error";
    }
    $mensaje = (array) [
        "mensaje"=> validacion($res),
        "notas"=> $_DATA,
        "promedio"=> $res
    ];

    echo json_encode($mensaje,JSON_PRETTY_PRINT);

?>