<?php

$usuario = ($_POST[usuario]);
$password = ($_POST[password]);


include '../conexion.php';

try {
    $stmt = $conn->prepare("SELECT id, nombres, usuario, password, departamento FROM administradores WHERE usuario = ? ");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->bind_result($id_admin, $nombres_admin, $usuario_admin, $password_admin, $departamento_admin);
    $stmt->fetch();
    if ($usuario_admin) {
        if (password_verify($password, $password_admin)) {
            session_start();
            $_SESSION['nombre'] = $usuario_admin;
            $_SESSION['login'] = true;

            $respuesta = array(
                'respuesta' => 'correcto',
                'mensaje' => 'Password Correcto',
                'nombres' => $nombres_admin,
                'id_admin' => $id_admin,
                'departamento' => $departamento_admin
            );
        } else {
            $respuesta = array(
                'respuesta' => 'incorrecto',
                'mensaje' => 'password incorrecto'
            );
        }
    } else {
        $respuesta = array(
            'respuesta' => 'noexiste',
            'mensaje' => 'Admin no existe'
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