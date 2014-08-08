<?php
session_start();
require_once("conexion.php");
if (isset($_POST["correoElectronico"]) && isset($_POST["contrasena"])) {
	$correoElectronico = $_POST["correoElectronico"];
	$contrasena_cod = md5($_POST["contrasena"]);

	$consulta = "SELECT * FROM usuario WHERE correo_electronico = '$correoElectronico' AND contrasena = '$contrasena_cod';";
	$resultado = mysqli_query($conexion, $consulta);

	if ((mysqli_num_rows($resultado) == 1) && ($registroUsuario = mysqli_fetch_array($resultado))) 
	{
		$_SESSION["usuario_valido"] = $registroUsuario["id"];
		$_SESSION["nombre_usuario"] = $registroUsuario["nombre_usuario"];
?>
		<div class="dropdown-user">
        	<a class="account" onClick="mostrarMenuUsuario(this)"><span><a id="userPhoto" href="#" style="position:relative; top: -20px;"><img src="<?php echo 'foto_perfil/'.$registroUsuario["foto_usuario"]; ?>" style="border-radius: 50%;width:50px;height:50px;" /></a></span></a>
        	<div class="submenu" style="display: none;">
        		<ul class="root">     
		            <li><a href="#Perfil" >Perfil</a></li>
		            <li><a href="#Historial">Historial</a></li>
		            <li><a href="#misArticulos">Mis Articulos</a></li>
		            <li><a href="#logout">Logout</a></li>
          		</ul>
        	</div>
      	</div>
		
<?php
	}
}
?>