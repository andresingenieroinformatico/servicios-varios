<?php
include('./../../connection/connection.php');
session_start();

$fecha_apertura = date('Y-m-d H:i:s');
$precio = $_POST['price'];
$descripcion = $_POST['description'];
$ubicacion = $_POST['ubication'];
$servicio = $_POST['service'];
$id_usuario = $_SESSION['id_usuario'];

$validation = 0;

if (empty($precio)) $validation++;
if (empty($descripcion)) $validation++;
if (empty($ubicacion)) $validation++;
if (empty($servicio)) $validation++;

if ($validation === 0) {
     $stmt = $conn->prepare('INSERT INTO solicitud_servicios (fecha_apertura, precio_ofertado, descripcion, id_ubicacion, id_servicio, id_usuario) VALUES (?, ?, ?, ?, ?, ?)');
     if ($stmt) {
          // Ajusta los tipos de datos según sea necesario
          $stmt->bind_param("ssssss", $fecha_apertura, $precio, $descripcion, $ubicacion, $servicio, $id_usuario);

          if ($stmt->execute()) {
               $stmt->close();
               header('Location: ../../pages/servicios_page/servicios.php');
               exit();
          } else {
               // Error al ejecutar la consulta
               echo "Error al ejecutar la consulta: " . $stmt->error;
          }
     } else {
          // Error de preparación de la consulta
          echo "Error en la preparación de la consulta: " . $conn->error;
          header('Location: ./login.php?error=2');
          exit();
     }
} else {
     echo "Por favor completa todos los campos.";
}

$conn->close();
?>