<?php 
	
	require_once("Articulo.php");

	$articulo = new Articulo();
	
	if (isset($_POST["accion"])) 
	{
		
		switch ($_POST["accion"]) 
		{
			
			case 'articulos_categoria':
				$articulo->ArticulosPorCategoria($_POST["id"]);
				break;
			case 'buscar_articulos':
				$articulo->MostrarResultadoArticulos($_POST["texto"]);
				break;
			
			default:
				# code...
				break;
		}
	}
	else
	{	
		 $resultado = $articulo->ArticulosMasVistos();				

	}

?>