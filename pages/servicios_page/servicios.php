<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Servicios</title>
     <link rel="stylesheet" href="./../../css/servicios.css">
     <link rel="stylesheet" href="./../../css/scroll_bar.css">
     <link rel="stylesheet" href="./../../css/tooltip.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
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
                    <a href="./../servicios_page/solicitudes.php" class="servicios tooltip">
                         <span class="tooltiptext">Solicitudes</span>
                         <span class="material-symbols-outlined">work_history</span>
                    </a>
               <?php } ?>
          </nav>
     </header>
     <main class="grid-my-services">
          <?php
          include('./../../connection/connection.php');
          if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 2) {
               $sql = 'SELECT * FROM solicitud_servicios WHERE id_usuario=?';
               $stmt = $conn->prepare($sql);
               $stmt->bind_param('s', $_SESSION['id_usuario']);
               $stmt->execute();
               $result = $stmt->get_result();

               while ($row = $result->fetch_assoc()) {
                    $service = $conn->query('SELECT nombre_servicio FROM servicios WHERE id_servicio=' . $row["id_servicio"])->fetch_assoc();
                    $check_contratos = $conn->query('SELECT * FROM contratos WHERE id_solicitud=' . $row['id_solicitud']) ?>
                    <div class="grid-item">
                         <div class="head-modal">
                              <h4 class="title-service"><?php echo $service['nombre_servicio'] ?></h4>
                              <?php if ($check_contratos->num_rows === 0) { ?>
                                   <button class="material-symbols-outlined delete-service" data-id="<?php echo $row['id_solicitud'] ?>">delete</button>
                              <?php } ?>
                         </div>
                         <p class="description-modal"><?php echo $row['descripcion'] ?></p>
                         <div class="main-info">
                              <p class="ubication"><?php
                                                       $ubication = $conn->query('SELECT pais, region, ciudad FROM ubicaciones WHERE id_ubicacion=' . $row['id_ubicacion'])->fetch_assoc();
                                                       echo $ubication['pais'] . ' ' . $ubication['region'] . ' ' . $ubication['ciudad'] . ' ';
                                                       ?></p>
                              <p class="price"><?php echo $row['precio_ofertado'] ?></p>
                              <p class="open-date"><?php echo $row['fecha_apertura'] ?></p>
                         </div>
                    </div>
          <?php }
          } ?>
     </main>
     <?php
     if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo'] == 2) {
          $title = $conn->query('SELECT id_servicio, nombre_servicio FROM servicios');
          $ubication = $conn->query('SELECT * FROM ubicaciones');
     ?>
          <section class="add-work-form">
               <div class="set-relative">
                    <button class="material-symbols-outlined close-add-service">close</button>
                    <form class="form-work" action="./../servicios/add_work.php" method="post">
                         <div class="form-component">
                              <label for="title" class="label">Titulo:</label>
                              <select class="input-title" name="service" id="title" required>
                                   <?php while ($titulo = $title->fetch_assoc()) { ?>
                                        <option value="<?php echo htmlspecialchars($titulo['id_servicio']) ?>"><?php echo htmlspecialchars($titulo['nombre_servicio']) ?></option>
                                   <?php } ?>
                              </select>
                         </div>

                         <div class="form-component">
                              <label for="ubication" class="label">Ubicacion:</label>
                              <select class="input-ubication" id="ubication" name="ubication" required>
                                   <?php
                                   while ($row = $ubication->fetch_assoc()) { ?>
                                        <option value="<?php echo htmlspecialchars($row["id_ubicacion"]); ?>"><?php echo htmlspecialchars($row["pais"] . " " . $row["region"] . " " . $row["ciudad"]); ?></option>
                                   <?php
                                   }
                                   ?>
                              </select>
                         </div>

                         <div class="form-component">
                              <label for="description" class="label">Descripcion:</label>
                              <textarea class="input-description" name="description" id="description" cols="30" rows="10" required></textarea>
                         </div>

                         <div class="form-component">
                              <label for="price" class="label">Precio de venta:</label>
                              <input type="number" name="price" id="price" class="input-price" required>
                         </div>

                         <button class="add-work-form-btn">
                              <span>Añadir trabajo </span>
                              <span class="material-symbols-outlined">work</span>
                         </button>
                    </form>
               </div>
          </section>
          <button class="add-work">
               <span class="material-symbols-outlined">add</span>
          </button>
     <?php }
     $conn->close(); ?>
     <script>
          document.querySelectorAll('.delete-service').forEach(button => {
               button.addEventListener('click', function() {
                    const serviceid = this.getAttribute('data-id');

                    fetch('./../servicios/delete_service_worker.php', {
                              method: 'POST',
                              headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              body: 'id_solicitud_servicio=' + serviceid
                         })
                         .then(response => response.text())
                         .then(text => {
                              try {
                                   const data = JSON.parse(text);
                                   if (data.success) {
                                        button.closest('.grid-item').remove();
                                   } else {
                                        alert(data.error || 'Error al eliminar el servicio.');
                                   }
                              } catch (error) {
                                   console.error('Parsing error:', error, 'Response was:', text);
                              }
                         })
                         .catch(error => console.error('Fetch error:', error));
               });
          });

          document.querySelector('.add-work').addEventListener('click', () => {
               document.querySelector('.add-work-form').style.display = 'flex';
          })

          document.querySelector('.close-add-service').addEventListener('click', () => {
               document.querySelector('.add-work-form').style.display = 'none';
          })
     </script>
</body>

</html>