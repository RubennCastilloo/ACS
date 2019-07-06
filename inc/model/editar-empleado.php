<?php

$nombres = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
$apellidoPaterno = filter_var($_POST['apellido_paterno'], FILTER_SANITIZE_STRING);
$apellidoMaterno = filter_var($_POST['apellido_materno'], FILTER_SANITIZE_STRING);
$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$departamento = filter_var($_POST['departamento'], FILTER_SANITIZE_STRING);
$puesto = filter_var($_POST['puesto'], FILTER_SANITIZE_STRING);
$horario = filter_var($_POST['horario'], FILTER_SANITIZE_STRING);
$estado = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

include '../conexion.php';
try {
    $opciones = array(
        'cost' => 12
    );

    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);

    $stmt =$conn->prepare("UPDATE empleados SET nombres = ?, apellido_paterno = ?,  apellido_materno = ?, usuario = ?, password = ?, departamento = ?, puesto = ?, horario = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("sssssssssi", $nombres, $apellidoPaterno, $apellidoMaterno, $usuario, $hash_password, $departamento, $puesto, $horario, $estado, $id);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        $respuesta = array(
            'respuesta' => 'correcto'
        );
    } else {
        $respuesta = array(
            'respuesta' => 'error'
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

