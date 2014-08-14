<?php 
	require_once("conexion.php");

	session_start();
	if(isset($_POST['id'])) // Request para modificar el numero de articulos que el usuario desea comprar 
	{
		$id = $_POST['id'];
		$cantidad = $_POST['cantidad'];
		if(isset($_SESSION['carro'][$id]))
		{

			$_SESSION['carro'][$id]['cantidad'] = $cantidad;
			echo $cantidad;
		}
	}
	else if(isset($_GET["id"])) //Request para meter un articulo en el carrito y luego retornarlo como JSON 
	{
		$id = $_GET["id"];
		$result = mysqli_query($conexion, "SELECT * FROM articulo WHERE id = $id");
		$article = mysqli_fetch_assoc($result);

		$imagen = $article["foto_articulo"];
		$nombre = $article["nombre_articulo"];
		$precio = $article["precio_unidad"];
		$cantidad = $article["cantidad"];
		$descripcion = $article["descripcion"];
		

		if(empty($_SESSION['carro'][$id]))
		{
 			$articulo = array('imagen' => $imagen, 'nombre' => $nombre, 'precio' => $precio,
 							  'existencia' => $cantidad, 'descripcion' => $descripcion, 'cantidad' => 1);
			$_SESSION['carro'][$id] = $articulo;


		}
		else
		{
			return;	
		}

		echo json_encode($_SESSION['carro']);
	}
	else // si no es ninguna de las anteriores entonces es un simple retorno cuantos articulos hay en en carrito
	{
		$i = 0;
		if(isset($_SESSION['carro']))
		{
			foreach ($_SESSION['carro'] as $key => $value) 
			{
				$i++;
			}	
		}
		
		echo  $i;
	}
?>