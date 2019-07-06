<?php

$nombres = ($_POST['nombres']);
$deFecha = ($_POST['de-fecha']);
$aFecha = ($_POST['a-fecha']);

include '../conexion.php';

try {
    $stmt = $conn->prepare("SELECT * FROM registros WHERE fecha > {$deFecha} ");
    $stmt->bind_param('s', $deFecha);
    $stmt->execute();

    $stmt->bind_result($id_empleado, $nombres_empleado, $apellido_empleado, $horario, $hora, $fecha);
    $stmt->fetch();
    if ($fecha) {
        $respuesta = array(
            'datos' => array(
                'nombres' => $nombres_empleado,
                'hora' => $hora,
                'fecha' => $fecha
            )
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