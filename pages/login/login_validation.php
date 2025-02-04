<?php include('./../../connection/connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
     session_start();
     $row = $result->fetch_assoc();
     $hashed_password = $row['password']; // Obtener el hash de la contraseña

     // Verificar la contraseña ingresada con el hash almacenado
     if (password_verify($password, $hashed_password)) {
          $_SESSION['id_usuario'] = $row['id_usuario'];
          $_SESSION['nombre'] = $row['nombre'];
          $_SESSION['apellido'] = $row['apellido'];
          $_SESSION['correo'] = $row['correo'];
          $_SESSION['telefono'] = $row['telefono'];
          $_SESSION['direccion'] = $row['direccion'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['password'] = $password;
          $_SESSION['id_tipo'] = $row['id_tipo'];
          $_SESSION['id_ubicacion'] = $row['id_ubicacion'];

          if ($_SESSION['id_tipo']===3) {
               header('Location: ../admin/admin.php');
          }else{
               header('Location: ../../index.php');
          }
          exit();
     } else {
          // Contraseña incorrecta
          header('Location: ./login.php?error=1');
          exit();
     }
} else {
     header('Location: ./login.php?error=1');
     exit();
}

$stmt->close();
$conn->close();
