<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Solicitudes</title>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="./../../css/solicitudes.css">
     <link rel="stylesheet" href="./../../css/scroll_bar.css">
     <link rel="stylesheet" href="./../../css/tooltip.css">
</head>

<body>
     <header class="main-nav">
          <nav class="nav-items">
               <a href="./../../index.php" class="home tooltip">
                    <span class="tooltiptext">Inicio</span>
                    <span class="material-symbols-outlined">home</span>
               </a>
               <?php
               session_start();
               if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 2) { ?>
                    <a href="./../profile/profile.php" class="profile tooltip">
                         <span class="tooltiptext">Perfil</span>
                         <span class="material-symbols-outlined">account_circle</span>
                    </a>
                    <a href="./../servicios_page/servicios.php" class="servicios tooltip">
                         <span class="tooltiptext">Servicios</span>
                         <span class="material-symbols-outlined">work</span>
                    </a>
               <?php } ?>
          </nav>
     </header>
     <main class="grid-my-services">
          <?php
          if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 2) {
               include('./../../connection/connection.php');
               $id_usuario = $_SESSION['id_usuario'];

               // Consulta SQL para obtener coincidencias entre solicitud_servicios y contratos
               $sql = "SELECT c.* FROM contratos AS c INNER JOIN solicitud_servicios AS s ON s.id_solicitud = c.id_solicitud WHERE s.id_usuario = ?";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s", $id_usuario);
               $stmt->execute();
               $result = $stmt->get_result();

               while ($row = $result->fetch_assoc()) {
                    //lenando modal
                    $id_solicitud = $row['id_solicitud'];
                    $modal = $conn->query('SELECT fecha_apertura, precio_ofertado, descripcion, id_servicio FROM solicitud_servicios WHERE id_solicitud=' . $id_solicitud)->fetch_assoc();
                    $title = $conn->query('SELECT nombre_servicio FROM servicios WHERE id_servicio=' . $modal['id_servicio'])->fetch_assoc();

                    $id_usuario = $row['id_usuario'];
                    $user_data = $conn->query('SELECT nombre, apellido, correo, telefono, direccion, id_ubicacion FROM usuarios WHERE id_usuario=' . $id_usuario)->fetch_assoc();
                    $ubication = $conn->query('SELECT pais, region, ciudad FROM ubicaciones WHERE id_ubicacion=' . $user_data['id_ubicacion'])->fetch_assoc();
          ?>
                    <div class="grid-item">
                         <div class="head-modal">
                              <h4 class="title-modal"><?php echo $title['nombre_servicio'] ?></h4>
                         </div>
                         <p class="description-modal"><?php echo $modal['descripcion'] ?></p>
                         <div class="main-info">
                              <p class="price"><?php echo $modal['precio_ofertado'] ?></p>
                              <p class="open-date"><?php echo $modal['fecha_apertura'] ?></p>
                              <p class="user-data">Datos del usuario:</p>
                              <p class="name-user"><?php echo $user_data['nombre'] . ' ' . $user_data['apellido'] ?></p>
                              <p class="email"><?php echo $user_data['correo'] ?></p>
                              <p class="phone"><?php echo $user_data['telefono'] ?></p>
                              <p class="ubication"><?php echo $ubication['pais'] . ' ' . $ubication['region'] . ' ' . $ubication['ciudad'] ?></p>
                         </div>
                    </div>
          <?php }
               $stmt->close();
               $conn->close();
          }
          ?>
     </main>
</body>

</html>