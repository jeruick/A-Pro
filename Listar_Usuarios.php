<?php
  	require_once("conexion.php");
  	//session_start();
	//if(isset($_SESSION["usuario_valido"]))
	//{
		
		$query = "SELECT u.id AS id_usuario, nombre_usuario, fecha_nacimiento, sexo, numero_telefonico, correo_electronico,
				  foto_usuario, c.id, c.nombre_ciudad, p.id, p.nombre_pais 
				  FROM usuario u, ciudad c, pais p WHERE u.id_ciudad = c.id AND c.id_pais = p.id";
		$result = mysqli_query($conexion, $query);

	//}
	//else{ header("location: index.php");}
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
	    	background: rgba(0,0,200,0.2);
	    	border-radius: 20%;
	    	color: white;
	    	margin-left: 0.5em;
	    	margin-bottom: 2em;
			padding: 0.5em;
			text-decoration: none;
	    }
	    header
	    {
	    	background: url(img/back.png);
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
	<header><h1>Administracion de Usuarios</h1></header>
	<p id="home"><a href="index.php">Home</a></p>
	<table cellpadding="10" cellspacing="0	">
		<tr>
			<th>Foto</th>
			<th>Nombre</th>
			<th>Fecha Nacimiento</th>
			<th>Numero Telefono</th>
			<th>Correo Electronico</th>
			<th>Sexo</th>
			<th>Ciudad</th>
			<th>Pais</th>
			<th colspan= "2">Acciones</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)) { ?>		
			<tr>
				<td><img src="<?php echo "foto_perfil/".$row['foto_usuario']; ?>" style="width:100px; height:100px" /></td>
				<td><p><?php echo $row["nombre_usuario"]; ?></p></td>
				<td><p><?php echo $row["fecha_nacimiento"]; ?></p></td>
				<td><p><?php echo $row["numero_telefonico"]; ?></p></td>
				<td><p><?php echo $row["correo_electronico"]; ?></p></td>
				<td><p><?php echo $row["sexo"]; ?></p></td>
				<td><p><?php echo $row["nombre_ciudad"] ?></p></td>
				<td><p><?php echo $row["nombre_pais"] ?></p></td>
				<td><p><a href="modificar_usuario.php?id=<?php echo $row["id_usuario"];?>">Modificar</a></p></td>
				<td><p><a href="eliminar_usuario.php?id=<?php echo $row["id_usuario"];?>">Eliminar</a></p></td>

			</tr>
								
		<?php  } mysqli_free_result($result); ?>
		
	</table>

</body>
</html>