<?php
include('./../../connection/connection.php');
$sql = "SELECT * FROM ubicaciones";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrarse</title>
	<link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
	<link href="./../../css/register.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="./../../css/scroll_bar.css">
</head>

<body>
	<main class="login">
		<h2>Registrate</h2>

		<?php
		if (isset($_GET['error']) && $_GET['error'] == 1) {
			echo '<div class="error-message" style="color: red; text-align: center; margin-bottom: 10px;">Debes llenar los campos</div>';
		}
		?>

		<form action="./register_validation.php" class="form" method="post">
			<div class="form-name">
				<label for="name" class="form-label">Nombres:</label>
				<input class="form-name-input" id="name" placeholder="Juan Pablo" name="name" required>
			</div>

			<div class="form-lastname">
				<label for="lsuser" class="form-label">Apellidos:</label>
				<input class="form-lastname-input" id="lsuser" placeholder="Duran Perez" name="lastname" required>
			</div>

			<div class="form-email">
				<label for="email" class="form-label">Correo:</label>
				<input class="form-email-input" id="email" type="email" placeholder="jpablo.@gmail.com" name="email" required>
			</div>

			<div class="form-phone">
				<label for="phone" class="form-label">Telefono:</label>
				<input class="form-phone-input" id="phone" type="number" placeholder="3184396824" name="number">
			</div>

			<div class="form-direction">
				<label for="direction" class="form-label">direccion:</label>
				<input class="form-direction-input" id="direction" placeholder="Barrio la plaza" name="direction">
			</div>

			<div class="form-username">
				<label for="username" class="form-label">Usuario:</label>
				<input class="form-username-input" id="username" placeholder="juan p" name="username" required>
			</div>

			<div class="form-password">
				<label for="pwd" class="form-label">Clave:</label>
				<input class="form-password-input" id="pwd" type="password" placeholder="jsdhg&/#!){}5452*" name="password" required>
			</div>

			<div class="form-type-user">
				<label for="type-user" class="form-label">Tipo:</label>
				<select class="form-type-user-input" id="type-user" name="type">
					<option value="1">Usuario</option>
					<option value="2">Trabajador</option>
				</select>
			</div>

			<div class="form-ubication">
				<label for="ubication" class="form-label">Ubicacion:</label>
				<select class="form-ubication-input" id="ubication" name="ubication">
					
				<?php 
					while($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo htmlspecialchars($row["id_ubicacion"]);?>"><?php echo htmlspecialchars($row["pais"] . " " . $row["region"] . " " . $row["ciudad"]);?></option>
				<?php
					}
				?>
				</select>
			</div>

			<div class="form-actions">
				<button class="form-button">Registrarse</button>
			</div>
		</form>
	</main>
</body>

</html>