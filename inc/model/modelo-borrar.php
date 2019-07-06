<?php

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

include '../conexion.php';

try {
    $stmt = $conn->prepare("DELETE FROM empleados WHERE id = ?");  
    $stmt->bind_param("i", $id);
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

} catch(Exception $e) {
     $respuesta = array(
         'error' => $e-getMessage()
     );
}
echo json_encode($respuesta);

