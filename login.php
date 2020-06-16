<?php

session_start();

if(isset($_SESSION['user_id'])) {
	header('Location: /projects/chat/chat.php');
}

$message_er = "";
$message_va = "";
$stilo = "none";
$c_user = "";

require 'conection.php';

if(isset($_POST["send"]))
{
	if(!empty($_POST["user"]) && !empty($_POST["pass"])){
		$c_user = $_POST['user'];
		$records = $conn->prepare('SELECT id, user, pass FROM users WHERE user=:user');
		$records->bindParam(':user', $_POST['user']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		//$results = $records->fetchAll();

		if (!empty($results) > 0 && password_verify($_POST['pass'], $results['pass'])) {
			$_SESSION['user_id'] = $results["id"];
			header('Location: /projects/chat/chat.php');
		}
		else {
			$message_er = "El usuario y/o la contraseña no existen.";
			$stilo = "block";
		}
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
			<h1>Iniciar sesion</h1>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<input type="text" name="user" placeholder="Usuario" value="<?php echo $c_user ?>">
				<input type="password" name="pass" placeholder="Contraseña">
				<input type="submit" name="send" value="Enviar" class="boton">
			</form>
			<p id="suge">
				No tienes cuanta?, <a href="singup.php">Registrate.</a>
			</p>
		</div>
	</div>
	<div class="message-float" style=" display: <?php echo $stilo; ?>;">
		<p class="error"><?php echo $message_er; ?></p>
		<p class="else"><?php echo $message_va; ?></p>
	</div>
</body>
</html>