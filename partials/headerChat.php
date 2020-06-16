<header class="head">
	<span><a href="index.php">CHAT MAMOLON</a></span>

	<div class="box-content">
		<div class="content-button flex">
			<div class="boton-user flex" id="boton-box">
				<i class="fas fa-user-circle"></i>
			</div>
		</div>
	</div>
	
	<div class="box-info" id="box-info" >
		<h2 id="user-name"><?php echo $user['user']; ?></h2>
		<div class="user-boton">
			<a href="logout.php">Cerrar sesion</a>
		</div>
	</div>
	
	<script type="text/javascript">
		var box = document.getElementById('box-info');
		document.getElementById('boton-box').addEventListener('click', ()=>{
			if(box.style.display == "none"){
				box.style.display = "flex";
			}
			else {
				box.style.display = "none";
			}
		});

	</script>
</header>