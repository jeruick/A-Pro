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

		public function ActualizarInformacion($id, $nombre, $nacimiento, $genero, $numero_t, $correo, $foto,$ciudad)
		{
			if($foto != NULL)
	    	{
				

				move_uploaded_file($foto["tmp_name"], "foto_perfil/". $foto["name"]);
				$foto = $foto['name'];
				$query = "UPDATE usuario SET nombre_usuario = '$nombre', fecha_nacimiento = '$nacimiento', sexo='$genero', numero_telefonico = '$numero_t',correo_electronico ='$correo', foto_usuario ='$foto', id_ciudad = $ciudad WHERE id= $id";
			    mysqli_query(self::$conexion, $query);		    	 
		    }
		    else 
		    {
		    	$query = "UPDATE usuario SET nombre_usuario = '$nombre', fecha_nacimiento = '$nacimiento', sexo='$genero', 	numero_telefonico = '$numero_t',	correo_electronico='$correo', id_ciudad= $ciudad WHERE id= $id";

				mysqli_query(self::$conexion, $query);
		    }
		}

		public function ActualizarPassword($id, $password)
		{
       		$pass = md5($password);
            $consultaPass = "UPDATE usuario SET contrasena = '$pass' WHERE id= $id"; 
            mysqli_query(self::$conexion, $consultaPass); 		         
		}

		public function ObtenerInformacionUsuario($id)
		{
			   $consulta = "SELECT nombre_usuario, fecha_nacimiento, sexo, numero_telefonico, foto_usuario,
				correo_electronico, nombre_ciudad, nombre_pais, id_pais, id_ciudad
				FROM usuario, ciudad, pais 
				WHERE usuario.id = $id AND usuario.id_ciudad = ciudad.id AND ciudad.id_pais = pais.id";

				$result = mysqli_query(self::$conexion, $consulta);
				return $result;
		}
	}

?>