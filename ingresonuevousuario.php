<?php
require_once("conexion.php");

if (isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["sex"]) && isset($_POST["selCiudad"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["password"])) {
	$nombreUsuario = $_POST["name"];
	$fechaNacimiento = $_POST["date"];
	$sexo = $_POST["sex"];
	$numeroTelefono = $_POST["phone"];
	$correoElectronico = $_POST["email"];
	$contrasena_cod = md5($_POST["password"]);
	if($_FILES["picture"]["name"] != "")
	{
		$fotografia = $_FILES["picture"]["name"];	
	}
	else
	{
		$fotografia = "usuario_sin_foto.jpg";
	}
	
	$ciudad = $_POST["selCiudad"];

	$consultaRegistroUsuario = "INSERT INTO usuario VALUES (NULL, '$nombreUsuario', '$fechaNacimiento', '$sexo', '$numeroTelefono', '$correoElectronico', '$contrasena_cod', '$fotografia', '$ciudad');";
	$resultado = mysqli_query($conexion, $consultaRegistroUsuario);

	if (file_exists("foto_perfil/" . $_FILES["picture"]["name"])) {
		echo $_FILES["picture"]["name"] . " el archivo ya existe. ";
	} else {
		move_uploaded_file($_FILES["picture"]["tmp_name"], "foto_perfil/" . $_FILES["picture"]["name"]);
		echo "<br/> Stored in: " . "foto_perfil/" . $_FILES["picture"]["name"];
	}
}

if ($resultado == 1){
		header("Location: index.php");
}else {
		header("Location: registro_usuario.php");
}
?>
