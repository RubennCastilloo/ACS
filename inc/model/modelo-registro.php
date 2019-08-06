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
            $entrada = (int)$entrada_empleado + 4 . ':00:00';
            $salida = (int)$salida_empleado + 4 . ':00:00';
            $entradaRegistro = $entrada_empleado . ':30:00';
            $salidaRegistro = $salida_empleado . ':30:00';

            if ($hora >= $entrada_empleado && $hora < $entrada) {
                
                  include '../conexion.php';
                try {
                    
                    $horario_empleado = $entrada_empleado . " - " . $salida_empleado;
                    
                    $stmt = $conn->prepare("INSERT INTO registros (usuario, nombres, apellido, horario, hora, hora_salida, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('sssssss',$usuario, $nombres_empleado, $paterno_empleado, $horario_empleado, $hora, $vacio, $fecha);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'respuesta' => 'entrada',
                            'entrada_hora' => $entradaRegistro,
                            'hora' => $hora,
                            'entrada' => $entrada,
                            'salida' => $salida
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
        
            else if ($hora >= $salida_empleado && $hora < $salida && $fecha === $fecha) {
                
            
                  include '../conexion.php';
                  
                try {
                    $stmt = $conn->prepare("UPDATE registros SET hora_salida = ? WHERE fecha = ?");
                    $stmt->bind_param('ss', $hora, $fecha);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'respuesta' => 'salida',
                            'salida_hora' => $salidaRegistro,
                            'hora' => $hora,
                            'salida' => $salida
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'sinEntrada',
                    'mensaje' => 'No hay entrada registrada'
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
        
      } 
      else {
        $respuesta = array (
          'respuesta' => 'inactivo',
          'usuario' => $usuario_empleado,
          'error' => 'Empleado no existe'
        );
      }
      
    $stmt->close();
    $conn->close();
    }
    
    else {
        $respuesta = array (
          'respuesta' => 'noexiste',
          'error' => 'Empleado no existe'
        );
      }
      
      
    //   if ($hora >= $salida_empleado && $hora < ($salida_empleado + '10:00:00')) {
    //     $respuesta = array (
    //         'respuesta' => 'fueratiempo',
    //         'error' => 'Empleado esta fuera de tiempo'
    //       );
    //   }

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
// try {
//     $stmt = $conn->prepare("SELECT id, usuario FROM registros WHERE fecha = ?");
//     $stmt->bind_param('s', $fecha);
//     $stmt->execute();
//     $stmt->bind_result($id_registro, $usuario_registro);
//     $stmt->fetch(); 
// }