<?php
session_start();

require 'conection.php';

$user = null;

if (isset($_SESSION['user_id'])) {
	$records = $conn->prepare('SELECT id, user, pass FROM users WHERE id=:id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();

	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	$active = $conn->prepare('UPDATE `users` SET `active` = 1 WHERE `users`.`id` = :id');
	$active->bindParam(':id', $_SESSION['user_id']);
	$active->execute();

	if(count($results) > 0) {
		$user = $results;
	}

	$src = $conn->prepare('SELECT * FROM users');
	$src->execute();

	$user_list = $src->fetchAll();

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

	<!-- FONT AWESOME -->
	<script src="https://kit.fontawesome.com/f349cd4f76.js" crossorigin="anonymous"></script>
	<!-- Animate CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

	<title>Mi chat</title>
</head>
<body>
	
	<?php require 'partials/headerChat.php'; ?>

	<div class="container">

		<aside class="box-user flex">

			<?php foreach ($user_list as $value): ?>

				<?php if($value['user'] != $user['user']): ?>

				<div class="user-info boton-u" onclick="searchCat(<?= $value['id'] ?>)" id="<?= $value['id'] ?>">

					<h2><?php echo $value['user'] ?></h2>

					<p>
						<?php if($value['active']) {
									echo "Conectado";
								}
								else {
									echo "Desconectado";
								}
						?>
					</p>
				</div>
			<?php endif; endforeach ?>

		</aside>

		<div class="content-chat">

			<div class="chat-main">
				<div class="name-chat" id="name-chat"><span>Nombre</span></div>

				<div class="content-message me">
					<div class="box-chat me">
						<span>Mensaje 1</span>
					</div>
				</div>

				<div class="content-message you">
					<div class="box-chat you">
						<span>Mensaje 2</span>
					</div>
				</div>
			</div>

			<div class="box-messgae">
				<input type="text" name="text" placeholder="Escribe tu mensaje...">
				<button class="boton"><i class="fas fa-paper-plane"></i></button>
			</div>	
		</div>
	</div>

	<script src="assets/js/chat.js"></script>

</body>
</html>