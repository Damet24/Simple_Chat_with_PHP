<?php
session_start();

require 'conection.php';

if (isset($_SESSION['user_id'])) {
	$records = $conn->prepare('SELECT id, user, pass FROM users WHERE id=:id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();

	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	$user = null;

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
				<div class="user-info">

					<h2><?php echo $value['user'] ?></h2>

					<p>
						<?php if($value['active']) {
									echo "Activo";
								}
								else {
									echo "Ausente";
								} 
						?>
					</p>
				</div>
			<?php endforeach ?>

		</aside>

		<div class="content-chat">

			<div class="chat-main">

				<div class="content-message me">
					<div class="box-chat me">
						<span>Este es el mensaje que quiero mostrar.</span>
					</div>
				</div>

				<div class="content-message you">
					<div class="box-chat you">
						<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus culpa atque molestias, quia non. Id facilis animi adipisci sequi impedit, unde tempore laboriosam maiores odio ratione aspernatur quidem cumque harum.</span>
					</div>
				</div>

				<div class="content-message me">
					<div class="box-chat me">
						<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati numquam deleniti neque. Impedit ullam, perspiciatis, harum officiis eius dolorem hic, nihil inventore culpa, commodi deleniti ipsam sit sed iusto earum!</span>
					</div>
				</div>

				<div class="content-message you">
					<div class="box-chat you">
						<span>Este es el mensaje que quiero mostrar.</span>
					</div>
				</div>

				<div class="content-message me">
					<div class="box-chat me">
						<span>Hola, como estas?</span>
					</div>
				</div>

				<div class="content-message me">
					<div class="box-chat me">
						<span>Este es el mensaje que quiero mostrar.</span>
					</div>
				</div>

				<div class="content-message you">
					<div class="box-chat you">
						<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus culpa atque molestias, quia non. Id facilis animi adipisci sequi impedit, unde tempore laboriosam maiores odio ratione aspernatur quidem cumque harum.</span>
					</div>
				</div>

				<div class="content-message me">
					<div class="box-chat me">
						<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati numquam deleniti neque. Impedit ullam, perspiciatis, harum officiis eius dolorem hic, nihil inventore culpa, commodi deleniti ipsam sit sed iusto earum!</span>
					</div>
				</div>

				<div class="content-message you">
					<div class="box-chat you">
						<span>Este es el mensaje que quiero mostrar.</span>
					</div>
				</div>

				<div class="content-message me">
					<div class="box-chat me">
						<span>Hola, como estas?</span>
					</div>
				</div>

			</div>

			<div class="box-messgae">
				<input type="text" name="text" placeholder="Escribe tu mensaje...">
				<button class="boton"><i class="fas fa-paper-plane"></i></button>
			</div>	
		</div>
	</div>
</body>
</html>