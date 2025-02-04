<?php include('./connection/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Servicios varios</title>
     <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="stylesheet" href="./css/index.css">
     <link rel="stylesheet" href="./css/scroll_bar.css">
     <script type="module" src="./js/menu.js"></script>
</head>

<body>
     <header class="header">
          <nav class="header_nav">
               <ul class="header_nav_list">
                    <div class="header-main-options">
                         <?php session_start();
                         if (isset($_SESSION['id_tipo']) && ($_SESSION['id_tipo']==1 || $_SESSION['id_tipo']==2)) { ?>
                              <button class="material-symbols-outlined menu">menu</button>
                         <?php } ?>
                         <li class="main-search">
                              <input type="text" placeholder="Buscar servicio" class="main-input">
                              <?php if (!isset($_SESSION['username'])) { ?>
                                   <a href="./pages/home/aviso.html" class="important">Leer antes de usar</a>
                              <?php } ?>
                         </li>
                    </div>
                    <?php
                    if (!isset($_SESSION['username'])) { ?>
                         <div class="main-user-buttons">
                              <a class="header_main_options" href="./pages/register/register.php">
                                   <span class="material-symbols-outlined">person_add</span>
                                   <span>Registrarse</span>
                              </a>
                              <a class="header_main_options" href="./pages/login/login.php">
                                   <span class="material-symbols-outlined">login</span>
                                   <span>Iniciar sesion</span>
                              </a>
                         </div>
                    <?php } else { ?>
                         <div class="user-visual-options">
                              <div class="user-visual">
                                   <h4 class="username"><?php echo $_SESSION['username'] ?></h4>
                                   <img class="img-username" src="./assets/DNV.png" alt="perfil de ejemplo">
                              </div>
                              <form action="./connection/logout.php">
                                   <button class="material-symbols-outlined user-logout">logout</button>
                              </form>
                         </div>
                    <?php } ?>
               </ul>
          </nav>
     </header>
     <aside class="main-section">
          <nav>
               <ul class="user-aside-options">
                    <?php if (isset($_SESSION['id_tipo']) && ($_SESSION['id_tipo']==1 || $_SESSION['id_tipo']==2)) { ?>
                         <button class="material-symbols-outlined close">close</button>
                         <li class="aside-option">
                              <a href="./pages/profile/profile.php" class="main_options">
                                   <span class="material-symbols-outlined">account_circle</span>
                                   <span class="profile">Perfil</span>
                              </a>
                         </li>
                         <?php if ($_SESSION['id_tipo'] == 1) { ?>
                              <li class="aside-option">
                                   <a href="./pages/contratos/contratos.php" class="main_options">
                                        <span class="material-symbols-outlined">format_list_bulleted</span>
                                        <span class="task">Mis servicios</span>
                                   </a>
                              </li>
                         <?php } else { ?>
                              <li class="aside-option">
                                   <a href="./pages/servicios_page/servicios.php" class="main_options">
                                        <span class="material-symbols-outlined">work</span>
                                        <span class="task">Servicios</span>
                                   </a>
                              </li>
                              <li class="aside-option">
                                   <a href="./pages/servicios_page/solicitudes.php" class="main_options">
                                        <span class="material-symbols-outlined">work_history</span>
                                        <span class="task">Solicitudes</span>
                                   </a>
                              </li>
                    <?php }
                    } ?>
               </ul>
          </nav>
     </aside>
     <main class="servicios-grid">
          <?php
          $services = $conn->query('SELECT * FROM solicitud_servicios');
          while ($row = $services->fetch_assoc()) {
               $service = $conn->query('SELECT nombre_servicio, descripcion, id_categoria FROM servicios WHERE id_servicio=' . $row["id_servicio"])->fetch_assoc();
               $modalId = $row["id_solicitud"];

               //llenando cada modal
               $worker = $conn->query('SELECT nombre, apellido FROM usuarios WHERE id_usuario=' . $row["id_usuario"])->fetch_assoc();
               $category = $conn->query('SELECT nombre_categoria FROM categorias WHERE id_categoria=' . $service["id_categoria"])->fetch_assoc();
               $ubication = $conn->query('SELECT pais, region, ciudad FROM ubicaciones WHERE id_ubicacion=' . $row["id_ubicacion"])->fetch_assoc();
          ?>
               <div class="servicios-grid-item">
                    <h4><?php echo $service["nombre_servicio"] ?></h4>
                    <p><?php echo $row["descripcion"] ?></p>
                    <div class="grid-item-buttons">
                         <button id="button" class="material-symbols-outlined" onclick="openModal('<?php echo 'infoDialog' . $modalId; ?>')">account_box <span>Ver mas</span></button>
                         <?php if (isset($_SESSION['username'])) {
                              if ($_SESSION['id_tipo'] == 1 and !$row["fecha_cierre"]) { ?>
                                   <button id="buy-work" class="material-symbols-outlined" onclick="openModal('<?php echo 'formDialog' . $modalId; ?>')">shopping_cart <span><?php echo 'Comprar '."$" . $row["precio_ofertado"] ?></span></button>
                         <?php }
                         } ?>
                    </div>

                    <?php if (isset($_SESSION['username'])) {
                         if ($_SESSION['id_tipo'] == 1) { ?>
                              <dialog class="dialog-form" id="<?php echo "formDialog" . $modalId ?>">
                                   <form method="dialog">
                                        <button type="submit" class="material-symbols-outlined close-dialog">close</button>
                                   </form>
                                   <div class="dialog-form-user">
                                        <div class="quantity">
                                             <span class="material-symbols-outlined minus">
                                                  stat_minus_1
                                             </span>
                                             <span class="number">0</span>
                                             <span class="material-symbols-outlined add">
                                                  stat_1
                                             </span>
                                        </div>
                                        <button class="material-symbols-outlined buy-service">attach_money</button>
                                   </div>
                              </dialog>
                    <?php }
                    } ?>

                    <dialog class="dialog" id="<?php echo "infoDialog" . $modalId ?>">
                         <form method="dialog">
                              <button type="submit" class="material-symbols-outlined close-dialog">close</button>
                         </form>
                         <div class="dialog-info">
                              <h5><?php echo $worker["nombre"] . " " . $worker["apellido"] ?></h5>
                              <p><?php echo $category["nombre_categoria"] ?></p>
                              <p><?php echo $ubication["pais"] . " " . $ubication["region"] . " " . $ubication["ciudad"] ?></p>
                              <p><?php echo $row["fecha_apertura"] ?></p>
                              <p><?php if ($row["fecha_cierre"]) {
                                        echo $row["fecha_cierre"];
                                   } else {
                                        echo 'Abierto';
                                   }
                                   ?></p>
                              <p><?php echo $service["descripcion"] ?></p>
                         </div>
                    </dialog>
               </div>
          <?php }
          $conn->close(); ?>
     </main>
     <script src="./js/modal.js"></script>
     <script src="./js/filter.js"></script>
     <script>
          document.querySelectorAll('.add').forEach((addButton, index) => {
               addButton.addEventListener('click', (event) => {
                    const qtElement = event.target.closest('.dialog-form-user').querySelector('.number');
                    let count = parseInt(qtElement.textContent);
                    count++;
                    qtElement.textContent = count;
               });
          });

          document.querySelectorAll('.minus').forEach((minusButton, index) => {
               minusButton.addEventListener('click', (event) => {
                    const qtElement = event.target.closest('.dialog-form-user').querySelector('.number');
                    let count = parseInt(qtElement.textContent);
                    if (count > 0) {
                         count--;
                    }
                    qtElement.textContent = count;
               });
          });

          document.querySelectorAll('.buy-service').forEach((buyButton, index) => {
               buyButton.addEventListener('click', (event) => {
                    const formDialog = event.target.closest('.dialog-form-user');
                    const qtElement = formDialog.querySelector('.number');
                    const count = parseInt(qtElement.textContent);
                    const modalId = event.target.closest('dialog').id.replace('formDialog', '');

                    // Enviar los datos a buy_service.php usando Fetch
                    if (count > 0) {
                         fetch('./pages/servicios/buy_service.php', {
                                   method: 'POST',
                                   headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                   },
                                   body: `cantidad=${count}&id=${modalId}` // Enviar la cantidad y el id del modal
                              })
                              .then(response => response.text())
                              .then(data => {
                                   alert('Compra realizada con éxito.');
                                   const dialog = event.target.closest('dialog');
                                   if (dialog) {
                                        dialog.close();
                                   }
                              })
                              .catch(error => {
                                   console.error('Error al realizar la compra:', error);
                              });
                    }
               });
          });
     </script>

</body>

</html>