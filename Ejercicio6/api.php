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
    $notas = array_column($_DATA, 'notaDef');
    $registros = $_DATA; // Obtener los registros enviados desde el formulario

    foreach ($nombres as $nombre) {
        if (!is_string($nombre) || empty(trim($nombre)) || !preg_match('/^[A-Za-z]+$/', $nombre)) {
            $res = "Error, el nombre no puede ser numerico ni contener numeros";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    foreach ($notas as $nota) {
        if (!is_numeric($nota)) {
            $res = "Error: La nota debe ser numerica.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    $contadorMasculino = 0; 
    $contadorFemenino = 0; 

    // Recorrer los registros y contar por sexo
    foreach ($registros as $registro) {
        $sexo = $registro["sexo"];
        if ($sexo === "masculino") {
            $contadorMasculino++;
        } elseif ($sexo === "femenino") {
            $contadorFemenino++;
        }
    }

    $maxNota = max($notas);
    $maxNotaIndex = array_search($maxNota, $notas);
    $minNota = min($notas);
    $minNotaIndex = array_search($minNota, $notas);

    $personaMaxNota = array(
        "nombre" => $nombres[$maxNotaIndex],
        "notaDef" => $maxNota
    );
    $personaMinNota = array(
        "nombre" => $nombres[$minNotaIndex],
        "notaDef" => $minNota
    );

    return array(
        "Lista de Estudiantes" => $_DATA,
        "persona Con Mejor Nota" => $personaMaxNota,
        "persona Con Menor Nota" => $personaMinNota,
        "estudiantes Masculinos" => $contadorMasculino,
        "estudiantes Femeninas" => $contadorFemenino
    );
}

echo json_encode($res, JSON_PRETTY_PRINT);
?>