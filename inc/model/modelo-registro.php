<?php

$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
// $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$hora = ($_POST['hora']);
$fecha = ($_POST['fecha']);

include '../conexion.php';

try {
    $stmt = $conn->prepare("SELECT id, nombres, apellido_paterno, apellido_materno, usuario, password, departamento, puesto, horario, estado FROM empleados WHERE usuario = ?");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->bind_result($id_empleado, $nombres_empleado, $paterno_empleado, $materno_empleado, $usuario_empleado, $password_empleado, $departamento_empleado, $puesto_empleado, $horario_empleado, $estado_empleado);
    $stmt->fetch();
    if ($nombres_empleado) {
        //El usuario existe, verificar si esta activo
        if ($estado_empleado === 'activo') {
            // if (password_verify($password, $password_empleado)) {
            //     $respuesta = array (
            //         'resultado' => 'correcto',
            //         'hora' => $hora,
            //         'fecha' => $fecha,
            //         'id_empleado' => $id_empleado,
            //         'usuario' => $usuario_empleado,
            //         'horario' => $horario_empleado,
            //         'nombres' => $nombres_empleado,
            //         'apellido' => $paterno_empleado
            //       );
                  include '../conexion.php';
                try {
                    $stmt = $conn->prepare("INSERT INTO registros (nombres, apellido, horario, hora, fecha) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param('sssss', $nombres_empleado, $paterno_empleado, $horario_empleado, $hora, $fecha);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'respuesta' => 'correcto',
                            'hora' => $hora,
                            'fecha' => $fecha,
                            'nombres' => $nombres_empleado,
                            'usuario' => $usuario,
                            'apellido' => $paterno_empleado,
                            'horario' => $horario_empleado,
                            'id_insertado' => $stmt->insert_id
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

        //} else {
        //         //Login Incorrecto
        //         $respuesta = array (
        //           'respuesta' => 'incorrecto',
        //           'resultado' => 'Password Incorrecto',
        //           'usuario' => $usuario
        //         );
        //       }
         } else {
            $respuesta = array (
                'respuesta' => 'inactivo',
                'resultado' => 'Empleado inactivo',
                'usuario' => $nombres_empleado
              );
        }
      } else {
        $respuesta = array (
          'respuesta' => 'noexiste',
          'error' => 'Empleado no existe'
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


//                 $stmt = $conn->prepare("INSERT INTO registros (id_empleado, hora, fecha) VALUES (?, ?, ?");
//                 $stmt->bind_param('sss', $usuario, $hora, $fecha);
//                 $stmt->execute();
//                 if ($stmt->affected_rows > 0) {
//                     $respuesta = array(
//                         'respuesta' => 'correcto'
//                     );
//                 } else {
//                     $respuesta = array(
//                         'respuesta' => 'error'
//                     );
//                 }
