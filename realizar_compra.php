<?php 
	require_once("conexion.php");
	session_start();
	if(isset($_SESSION['usuario_valido']))
	{
		$id = $_SESSION['usuario_valido'];
		if(isset($_GET["id"]))
		{

			$id_articulo = $_GET["id"];
			$cantidad = $_GET["cantidad"];
			

			$query = "INSERT INTO usuario_articulo (id_usuario,id_articulo, cantidad) VALUES ($id, $id_articulo, $cantidad)";
				mysqli_query($conexion, $query);
				
			$query2 = "UPDATE articulo SET cantidad =  cantidad - $cantidad  WHERE id = $id_articulo";
			mysqli_query($conexion,$query2);			
		}
		else
		{
			foreach ($_SESSION['carro'] as $key => $value) 
			{
				$cantidad = $value["cantidad"];
				$existencia = $value["existencia"];

				$query = "INSERT INTO usuario_articulo (id_usuario,id_articulo, cantidad) VALUES ($id, $key, $cantidad)";
				mysqli_query($conexion, $query);
				
				$query2 = "UPDATE articulo SET cantidad = ($existencia - $cantidad) WHERE id = $key";
				mysqli_query($conexion,$query2);
			}
			unset($_SESSION['carro']);	
		}
		
		echo "Gracias por su compra";
	}
	else
	{
		return;
	}
?>