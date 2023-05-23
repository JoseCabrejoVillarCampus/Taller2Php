<?php
    
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    if (is_numeric($_DATA["num"])){
        function validacion($num){
            return ($num % 2 === 0) ? "Par" : "Impar";
        };
        function validacion1($num){
            return ($num >= 10)? "El numero es mayor a 10":"El numero es menor a 10";
        }
        $num = $_DATA["num"];
        
        $mensaje = (array) [
            "Numero"=> $_DATA["num"],
            "Par o Impar"=> validacion($num),
            "Mayor o Menor a 10"=> validacion1($num)
            
        ];
        try {
            $res = match ($METHOD) {
                "POST" => validacion('num')
            };
        } catch (\Throwable $th) {
            $res = "Error";
        }
        ;
    
        echo json_encode($mensaje,JSON_PRETTY_PRINT);
    } else{
        echo "El valor debe ser numerico";
    }
    

?>