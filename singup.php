<?php

session_start();

if(isset($_SESSION['user_id'])) {
	header('Location: /projects/chat/chat.php');
}

require 'conection.php';

$message_er = "";
$message_va = "";
$stilo = "none";

$c_user = "";
$c_pass = "";
$c_passC = "";

$singupOk = false;

if(isset($_POST["send"]))
{
	$c_user = $_POST["user"];
	$c_pass = $_POST["pass"];
	$c_passC = $_POST["pass-c"];

	if(!empty($_POST["user"]) && !empty($_POST["pass"]) && !empty($_POST["pass-c"])){
		$u = $_POST["user"];

		$sql = 'SELECT * FROM users';
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$res = $stmt->fetchAll();

		foreach ($res as $dato) {
			if($dato["user"] == $u){
				$message_er = "El usuario ingresado ya existe, intente con otro.";
				$stilo = "block";
				$singupOk = false;
				break;
			}
			else {
				$singupOk = true;
			}
		}

		if($singupOk){
			if($c_pass == $c_passC){
				if(strlen($c_pass) < 16){
					$sql_inser = "INSERT INTO `users` (`id`, `user`, `pass`) VALUES (NULL, ?, ?)";
					$stmt = $conn->prepare($sql_inser);
					$stmt->bindParam(1, $_POST["user"]);
					$password = password_hash($_POST["pass"], PASSWORD_BCRYPT);
					$stmt->bindParam(2, $password);
					if($stmt->execute()){
						$message_va = "Se ha registrado satisfactoriamente.";
						$stilo = "block";
					}
					else {
						$message_er = "Lo siento, se ha producido un error";
						$stilo = "block";
					}
				}
				else {
					$message_er = "La contraseña no debe exeder los 15 caracteres.";
					$stilo = "block";
				}
			}
			else {
				$message_er = "La contraseña no coincide";
				$stilo = "block";
			}
		}
	}
	else {
		$message_er = "Debes llenar todos los campos.";
		$stilo = "block";
	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@400;700&display=swap" rel="stylesheet"> 

	<!-- -->
	<title>Mi chat</title>
</head>
<body>

	<?php require 'partials/header.php'; ?>

	<div class="content">
		<div class="box">
			<h1>Registrarse</h1>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<input type="text" name="user" placeholder="Usuario" value="<?php echo $c_user ?>">
				<input type="password" name="pass" placeholder="Contraseña">
				<input type="password" name="pass-c" placeholder="Confirmár contraseña">
				<input type="submit" name="send" value="Enviar" class="boton">
			</form>
			<p id="suge">
				Ya tienes cuanta?, <a href="login.php">inicia sesion.</a>
			</p>
		</div>
		<div class="message-float" style=" display: <?php echo $stilo; ?>;">
			<p class="error"><?php echo $message_er; ?></p>
			<p class="else"><?php echo $message_va; ?></p>
		</div>
	</div>
</body>
</html>