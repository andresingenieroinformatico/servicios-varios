<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar sesion</title>
	<link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
	<link href="./../../css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
	<main class="login">
		<h2>Iniciar Sesion</h2>

		<?php
		if (isset($_GET['error']) && $_GET['error'] == 1) {
			echo '<div class="error-message" style="color: red;">Usuario o clave incorrectos</div>';
		}
		?>

		<form action="./login_validation.php" class="form" method="post">
			<div class="form-username">
				<label for="user" class="form-label">Usuario:</label>
				<input class="form-username-input" id="user" placeholder="pedro" name="username" required>
			</div>
			<div class="form-password">
				<label for="pwd" class="form-label">Clave:</label>
				<input type="password" class="form-password-input" id="pwd" placeholder="Clave de acceso" name="password" required>
			</div>
			<div class="form-actions">
				<button class="form-button">Iniciar sesion</button>
				<a href="./../register/register.php">Registrarse</a>
			</div>
		</form>
	</main>
</body>

</html>