<?php
include('./../../connection/connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $cantidad = $_POST['cantidad'];
     $id_solicitud = $_POST['id'];
     $id_usuario=$_SESSION['id_usuario'];
     $stmt=$conn->prepare('INSERT INTO contratos (id_solicitud, id_usuario) VALUES (?, ?)');

     for ($i=0; $i < $cantidad; $i++) { 
          $stmt->bind_param("ss",$id_solicitud, $id_usuario);
          $stmt->execute();
     }
     $stmt->close();
     $conn->close();
}
?>