<?php

$nombres = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
$apellidoPaterno = filter_var($_POST['apellido_paterno'], FILTER_SANITIZE_STRING);
$apellidoMaterno = filter_var($_POST['apellido_materno'], FILTER_SANITIZE_STRING);
$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
$departamento = filter_var($_POST['departamento'], FILTER_SANITIZE_STRING);
$puesto = filter_var($_POST['puesto'], FILTER_SANITIZE_STRING);
$entrada = filter_var($_POST['entrada'], FILTER_SANITIZE_STRING);
$salida = filter_var($_POST['salida'], FILTER_SANITIZE_STRING);
$estado = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

include '../conexion.php';
try {


    $stmt =$conn->prepare("UPDATE empleados SET nombres = ?, apellido_paterno = ?,  apellido_materno = ?, usuario = ?, departamento = ?, puesto = ?, entrada = ?, salida = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("sssssssssi", $nombres, $apellidoPaterno, $apellidoMaterno, $usuario, $departamento, $puesto, $entrada, $salida, $estado, $id);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        $respuesta = array(
            'respuesta' => 'correcto'
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

