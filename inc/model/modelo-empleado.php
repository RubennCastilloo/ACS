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





include '../conexion.php';

try {
    $stmt = $conn->prepare("SELECT id, nombres, apellido_paterno, apellido_materno, usuario, departamento FROM empleados WHERE usuario = ? ");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->bind_result($id_empleado, $nombres_empleado, $paterno_empleado, $materno_empleado, $usuario_empleado, $departamento_empleado);
    $stmt->fetch();
    if ($nombres_empleado) {
        $respuesta = array(
            'respuesta' => 'existe',
            'nombre' => $nombres,

        );
    } else {
        $respuesta = array(
            'respuesta' => 'correcto',
            'nombre' => $nombres_empleado,
            'usuario' => $usuario_empleado

        );




            $stmt = $conn->prepare("INSERT INTO empleados (nombres, apellido_paterno, apellido_materno, usuario, departamento, puesto, entrada, salida, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssssssss', $nombres, $apellidoPaterno, $apellidoMaterno, $usuario, $departamento, $puesto, $entrada, $salida, $estado);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'nombres' => $nombres,
                    'apellido_paterno' => $apellidoPaterno,
                    'apellido_materno' => $apellidoMaterno,
                    'usuario' => $usuario,
                    'departamento' => $departamento,
                    'puesto' => $puesto,
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'estado' => $estado,
                    'id_insertado' => $stmt->insert_id
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
    }




            
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    $respuesta = array(
        'error' => $e->getMessage()
    );
}

echo json_encode($respuesta);


