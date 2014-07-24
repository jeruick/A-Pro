<?php 
	if(isset($_POST["usuario"]))
	{
		$usuario = $_POST["usuario"];
		$pass = $_POST["pass"];
		$result = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$usuario' AND pass = '$pass'");
		if(mysqli_num_rows($result) > 0)
		{ $row = mysqli_fetch_assoc($result);
			?>
			<div class="dropdown">
	            <a class="account" ><span><?php echo row["nombre"]; ?></span></a>
	            <div class="submenu" style="display: none;">
	                <ul class="root">
	                    <li><a href="#Dashboard" ><img src='<?php echo "images/".$row["foto"]; ?>'></a></li>        
	                    <li><a href="#Profile" >Perfil</a></li>
	                    <li><a href="#settings">Historial</a></li>
	                    <li><a href="#signout">Cerrar Sesion</a></li>
	                </ul>
	            </div>
	        </div>
		<?php } mysqli_free_result($result); ?>
		
<?php	} ?>