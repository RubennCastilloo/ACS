<?php

$nombres = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
$apellido_paterno = filter_var($_POST['apellido-paterno'], FILTER_SANITIZE_STRING);
$apellido_materno = filter_var($_POST['apellido-materno'], FILTER_SANITIZE_STRING);
$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$departamento = filter_var($_POST['departamento'], FILTER_SANITIZE_STRING);



include '../conexion.php';

try {
    $stmt = $conn->prepare("SELECT id, nombres, apellido_paterno, apellido_materno, usuario, password, departamento FROM administradores WHERE usuario = ? ");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();

    $stmt->bind_result($id_empleado, $nombres_empleado, $paterno_empleado, $materno_empleado, $usuario_empleado, $password_empleado, $departamento_empleado);
    $stmt->fetch();
    if ($nombres_empleado) {
        $respuesta = array(
            'respuesta' => 'existe',
            'usuario' => $usuario_empleado,
            'nombre' => $nombres_empleado,
            'apellido' => $apellido_paterno,
            'departamento' => $departamento,
            'id_insertado' => $stmt->insert_id
        );
    } else {
        $respuesta = array(
            'respuesta' => 'correcto',
            'usuario' => $usuario
        );

        //USUARIO NO EXISTE, INSERTAR DATOS

        //Hashear password
            $opciones = array(
                'cost' => 12
            );

            $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);

        //Realizar la consulta a la base de datos
            $stmt = $conn->prepare("INSERT INTO administradores (nombres, apellido_paterno, apellido_materno, usuario, password, departamento) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $nombres, $apellido_paterno, $apellido_materno, $usuario, $hash_password, $departamento);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'nombres' => $nombres,
                    'apellido_paterno' => $apellido_paterno,
                    'apellido_materno' => $apellido_materno,
                    'usuario' => $usuario,
                    'password' => $hash_password,
                    'departamento' => $departamento,
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