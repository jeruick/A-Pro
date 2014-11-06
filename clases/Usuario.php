<?php 
	
	class Usuario
	{
		private static $conexion;
		function __construct()
		{
			require("Conexion.php");
			self::$conexion = $conexion;
		}

		public function ObtenerUsuario($id)
		{
			$result = mysqli_query(self::$conexion, "SELECT * FROM usuario WHERE id = $id");
			return $result;
		}

		public function LogearUsuario($correoElectronico, $contrasena_cod)
		{
			require("login.php");
			
		}
	}

?>