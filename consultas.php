<?php 
	require_once("conexion");
	session_start();



	if(isset($_GET["id"])) //pagina de listar usuarios
	{
		$id = $_GET["id"];
		mysqli_query($conexion, "DELETE FROM usuario WHERE id = $id");

	}

	if(isset($_SESSION['usuario_valido']))
	{

		if(isset($_GET["id"]))//pagina de modificar usuarios
		{
			$id = $_GET['id'];
			$result = mysqli_query($conexion,"SELECT * FROM usuario WHERE id = $id");
		}

		if(isset($_POST["id"])) // pagina de modificar usuarios
		{
			$id = $_POST["id"];
			$nombre = $_POST["nombre"];
			$fecha_nacimiento = $_POST["fecha"];
			$sexo = $_POST["sexo"];
			$telefono = $_POST["telefono"];
			$correo = $_POST["correo"];
			$contrasena = $_POST["contrasena"];
			$foto = $_POST["foto"];
			$ciudad = $_POST["ciudad"];
			$admin = $_POST["admin"];

			mysqli_query($conexion, "UPDATE usuario SET nombre_usuario = $nombre, fecha_nacimiento = $fecha_nacimiento, sexo = $sexo, numero_telefonico = $telefono, correo_electronico = $correo, contrasena = $contrasena, foto_usuario = $foto, id_ciudad = $ciudad, admin = $admin WHERE id = $id");

		}
		else  
		{
			header("Location: index.php");
		}	
	}

	
	
?>