<?php

function obtenerEmpleados() {
     include 'conexion.php';
     try {
          return $conn->query("SELECT id, nombres, apellido_paterno, apellido_materno, usuario, departamento, puesto, entrada, salida, estado FROM empleados");
     } catch (Exception $e) {
          echo "Error!" . $e->getMessage() . "<br>";
          return false;
     }
}

//Obtiene un empleado y toma un ID
function obtenerEmpleado($id) {
     include 'conexion.php';
     try {
          return $conn->query("SELECT id, nombres, apellido_paterno, apellido_materno, usuario, departamento, puesto, entrada, salida, estado FROM empleados WHERE id = $id");
     } catch (Exception $e) {
          echo "Error!" . $e->getMessage() . "<br>";
          return false;
     }
}

function obtenerHorarios() {
     include 'conexion.php';
     try {
          return $conn->query("SELECT id, entrada, salida FROM horarios");
     } catch (Exception $e) {
          echo "Error!" . $e->getMessage() . "<br>";
          return false;
     }
}

function obtenerHorario($id) {
     include 'conexion.php';
     try {
          return $conn->query("SELECT id, entrada, salida FROM horarios WHERE id = $id");
     } catch (Exception $e) {
          echo "Error!" . $e->getMessage() . "<br>";
          return false;
     }
}

function obtenerRegistros() {
     include 'conexion.php';
     try {
          return $conn->query("SELECT id, nombres, apellido, horario, hora, hora_salida, fecha FROM registros");
     } catch (Exception $e) {
          echo "Error!" . $e->getMessage() . "<br>";
          return false;
     }
}

function obtenerAdministradores() {
     include 'conexion.php';
     try {
          return $conn->query("SELECT id, nombres, apellido_paterno, usuario, departamento FROM administradores");
     } catch (Exception $e) {
          echo "Error!" . $e->getMessage() . "<br>";
          return false;
     }
}

