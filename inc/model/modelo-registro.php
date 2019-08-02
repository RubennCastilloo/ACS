<?php

$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
// $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$hora = ($_POST['hora']);
$fecha = ($_POST['fecha']);
$vacio = "";

include '../conexion.php';

try {
    $stmt = $conn->prepare("SELECT id, nombres, apellido_paterno, apellido_materno, usuario, departamento, puesto, entrada, salida, estado FROM empleados WHERE usuario = ?");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->bind_result($id_empleado, $nombres_empleado, $paterno_empleado, $materno_empleado, $usuario_empleado, $departamento_empleado, $puesto_empleado, $entrada_empleado, $salida_empleado, $estado_empleado);
    $stmt->fetch();
    if ($nombres_empleado) {
        //El usuario existe, verificar si esta activo
        if ($estado_empleado === 'activo') {
            if ($hora >= '06:00:00' && $hora < '10:00:00') {
            
                  include '../conexion.php';
                try {
                    $stmt = $conn->prepare("INSERT INTO registros (nombres, apellido, horario, hora, hora_salida, fecha) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('ssssss', $nombres_empleado, $paterno_empleado, $horario_empleado, $hora, $vacio, $fecha);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'respuesta' => 'entrada',
                            'hora' => $hora
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

        } 
            else if ($hora >= '10:05:00' && $hora < '24:00:00') {
            
                  include '../conexion.php';
                  
                try {
                    $stmt = $conn->prepare("UPDATE registros SET hora_salida = ? WHERE nombres = ?");
                    $stmt->bind_param('ss', $hora, $nombres_empleado);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'respuesta' => 'salida',
                            'hora' => $hora
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

        } 
      } else {
        $respuesta = array (
          'respuesta' => 'noexiste',
          'error' => 'Empleado no existe'
        );
      }
    $stmt->close();
    $conn->close();
    }

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
