<?php
include('./../../connection/connection.php');

// Recoger datos de entrada
$name = $_POST['name'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['number'] ?? '';
$direction = $_POST['direction'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$type = $_POST['type'] ?? '';
$ubication = $_POST['ubication'] ?? '';

$validation = 0;

// Validar entradas
if (empty($name)) $validation++;
if (empty($lastname)) $validation++;
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $validation++; // Validación del correo
if (empty($username)) $validation++;
if (empty($password)) $validation++;
if (empty($type)) $validation++;
if (empty($ubication)) $validation++;

if ($validation === 0) {
     // Preparar la consulta para evitar inyección SQL
     $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, correo, telefono, direccion, username, password, id_tipo, id_ubicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

     // Cifrar la contraseña
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     // Ejecutar la consulta
     if ($stmt) {
          $stmt->bind_param("sssssssss", $name, $lastname, $email, $phone_number, $direction, $username, $hashed_password, $type, $ubication);
          $stmt->execute();
          $stmt->close();

          header('Location: ../../index.php');
          exit();
     } else {
          // Manejo de error en la preparación de la consulta
          header('Location: ./login.php?error=2'); // Error específico
          exit();
     }
} else {
     header('Location: ./login.php?error=1');
     exit();
}

$conn->close();
