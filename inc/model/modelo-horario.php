<?php

$hora_entrada = ($_POST['hora_entrada']);
$hora_salida = ($_POST['hora_salida']);


include '../conexion.php';

try {
    $stmt = $conn->prepare("INSERT INTO horarios (entrada, salida) VALUES (?, ?)");
    $stmt->bind_param('ss', $hora_entrada, $hora_salida);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $respuesta = array(
            'respuesta' => 'correcto',
            'hora_entrada' => $hora_entrada,
            'hora_salida' => $hora_salida,
            'id_insertado' => $stmt->insert_id
        );
    } else {
        $respuesta = array(
            'respuesta' => 'error',
            'mensaje' => 'Houston tenemos un problema'
        );
    }
$stmt->close();
$conn->close();
} catch (Exception $e) {
    $respuesta = array(
        'error' => $e->getMessage()
    );
}

echo json_encode($respuesta);