<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $nombres = array_column($_DATA, 'nombre');
    $notas = array_column($_DATA, 'notaDef');
    $registros = $_DATA; // Obtener los registros enviados desde el formulario

    $contadorMasculino = 0; // Contador para estudiantes de sexo masculino
    $contadorFemenino = 0; // Contador para estudiantes de sexo femenino

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
    $minNotaIndex= array_search($minNota, $notas);

    $personaMaxNota = array(
        "nombre" => $nombres[$maxNotaIndex],
        "notaDef" => $maxNota
    );
    $personaMinNota = array(
        "nombre" => $nombres[$minNotaIndex],
        "notaDef" => $minNota
    );

    $mensaje = array(
        "Lista de Estudiantes" => $_DATA,
        "persona Con Mejor Nota" => $personaMaxNota,
        "persona Con Menor Nota" => $personaMinNota,
        "estudiantes Masculinos" => $contadorMasculino,
        "estudiantes Femeninas" => $contadorFemenino
    );

    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>
