<?php
  	require_once("conexion.php");
  	session_start();
	if(isset($_SESSION["usuario_valido"]))
	{
		$id = $_SESSION["usuario_valido"];
		$query = "SELECT a.nombre_articulo, a.descripcion ,a.marca, a.precio_unidad, a.foto_articulo, ua.cantidad, ua.fecha_compra    				 FROM articulo a,usuario_articulo ua WHERE a.id = ua.id_articulo AND ua.id_usuario = $id";
		$result = mysqli_query($conexion, $query);

	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8"> 
   	
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/globals.css">
	<style type="text/css">
	    body
	    {
	    	background: rgb(255,250,250);
	    	margin: 0;
	    	padding: 0;
	    }
	    a
	    {
	    	background: rgb(100,240,200);
	    	border-radius: 20%;
	    	color: white;
	    	margin-left: 0.5em;
	    	margin-bottom: 2em;
			padding: 0.5em;
			text-decoration: none;
	    }
	    header
	    {
	    	background: url(img/history.png) no-repeat, url(img/back.png);
	    	background-size: 150px;
	    	margin: 0;
	    	padding: 1em;
	    }
		h1
		{
			color: white;
			text-shadow: rgba(0,0,0,0.7) 2px 2px 10px;
			text-align: center;
		}
		th, td
		{
			border: 2px solid white;
			box-shadow: rgba(0,0,0,0.2) 0px 0px 10px;
			margin: 0px;
		}
		table
		{
			margin: 0 auto;
		}

	</style>

</head>
<body>
	<header><h1>Mi Historial De Compras</h1></header>
	<p id="home"><a href="index.php">Home</a></p>
	<table cellpadding="10" cellspacing="0	">
		<tr>
			<th>Foto</th>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>marca</th>
			<th>Fecha de compra</th>
			<th>Precio unidad</th>
			<th>Cantidad</th>
			<th>Total</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)) { ?>		
			<tr>
				<td><img src="<?php echo "articulos/".$row['foto_articulo']; ?>" style="width:100px; height:100px" /></td>
				<td><p><?php echo $row["nombre_articulo"]; ?></p></td>
				<td><p><?php echo $row["descripcion"]; ?></p></td>
				<td><p><?php echo $row["marca"]; ?></p></td>
				<td><p><?php echo $row["fecha_compra"]; ?></p></td>
				<td><p><?php echo "L. ".$row["precio_unidad"] ?></p></td>
				<td><p><?php echo $row["cantidad"] ?></p></td>
				<td><p><?php echo "L. ".$row["cantidad"]*$row["precio_unidad"]; ?></p></td>
			</tr>
								
		<?php  } mysqli_free_result($result);	 ?>
		
	</table>

</body>
</html>