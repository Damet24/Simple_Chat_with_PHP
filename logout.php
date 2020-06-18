<?php

require 'conection.php';

session_start();

if (isset($_SESSION['user_id'])) {
	$active = $conn->prepare('UPDATE `users` SET `active` = 0 WHERE `users`.`id` = :id');
	$active->bindParam(':id', $_SESSION['user_id']);
	$active->execute();
}

session_unset();

session_destroy();

header('Location: /projects/chat');

?>