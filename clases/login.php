<?php

if (isset($correoElectronico) && isset($contrasena_cod))
 {
 	$contrasena_cod = md5($contrasena_cod);
	$consulta = "SELECT * FROM usuario WHERE correo_electronico = '$correoElectronico' AND contrasena = '$contrasena_cod';";
	$resultado = mysqli_query(self::$conexion, $consulta);
	
	if ((mysqli_num_rows($resultado) == 1) && ($registroUsuario = mysqli_fetch_array($resultado))) 
	{
		$_SESSION["usuario_valido"] = $registroUsuario["id"];
		$_SESSION["nombre_usuario"] = $registroUsuario["nombre_usuario"];

	}

  
}
?>