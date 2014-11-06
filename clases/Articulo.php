<?php 

	
	class Articulo 
	{
		
		private static $conexion;
		
		function __construct()
		{
			require("Conexion.php");
			self::$conexion = $conexion;
		}

		public function ArticulosPorCategoria($id)
		{
			require_once("articulos_categoria.php");
  		
		}

		public function ArticulosMasVistos()
		{
			require_once("articulos_mas_vistos.php");
			return $resultado;
		}

		public function BuscarTodosArticulos()
		{
			$result = mysqli_query(self::$conexion, "SELECT * FROM articulo");
			return $result;
		}
		public function MostrarResultadoArticulos($texto)
		{
			require_once("mostrar_resultados_articulos.php");
		}

		public function BuscarArticulos($texto, $categoria)
		{
			$query = "SELECT * FROM articulo WHERE nombre_articulo LIKE '%$texto%' AND id_categoria = $categoria AND cantidad > 0";
        	$result = mysqli_query(self::$conexion, $query);
        	return $result;
		}

		public function AumentarVisitaArticulo($id)
		{
			mysqli_query(self::$conexion, "UPDATE articulo SET visitas = visitas + 1 WHERE id = $id");
		}

		public function BuscarArticulosSinCategoria($texto)
		{
			
			$result = mysqli_query(self::$conexion, "SELECT * FROM articulo WHERE nombre_articulo LIKE '%$texto%' AND cantidad > 0");
			return $result;
		}
	}
?>
