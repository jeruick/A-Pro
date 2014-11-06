<?php 
	

	class Categoria
	{
		private static $conexion;
			
		function __construct()
		{
			require ('Conexion.php');			
			self::$conexion = $conexion;
		}

		public function ObtenerCategorias()
		{	
  			$result = mysqli_query(self::$conexion, "SELECT * FROM categoria");
  			return $result; 
		}

		public function BuscarCategoria($id)
		{
			$resultCat = mysqli_query(self::$conexion, "SELECT * FROM categoria WHERE id = $id");
			return $resultCat;
		}
	}
?>