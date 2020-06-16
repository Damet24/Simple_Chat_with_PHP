<?php

session_start();

if(isset($_SESSION['user_id'])) {
	header('Location: /projects/chat/chat.php');
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
	
	<?php require 'partials/headerStart.php'; ?>

	<div class="content">
		<h1 class="text-home">Bienvenido al Chat Mamolon!</h1>
	</div>
</body>
</html>