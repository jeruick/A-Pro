<?php
  	require_once("conexion.php");
  	session_start();
	if(isset($_SESSION["usuario_valido"]))
	{
		$id= $_SESSION["usuario_valido"];


	  if (isset($_POST["txtNombre"]))
	  {

			$nombreArticulo = $_POST["txtNombre"];
			$marca = $_POST["txtMarca"];
			$precio = $_POST["txtPrecio"];
			$cantidad = $_POST["txtCantidad"];
			$condicion = $_POST["slEstado"];
			$descripcion = $_POST["txtDescripcion"];
			$categoria = $_POST["slCategoria"];
			$foto = $_FILES["txtFoto"]["name"];

			if($_FILES["txtFoto"]["error"] > 0){

				 echo "Error: " . $_FILES["txtFoto"]["error"] . "<br>";
			}
			else{

			move_uploaded_file($_FILES["txtFoto"]["tmp_name"], "Articulos/" . $_FILES["txtFoto"]["name"]);

			$consulta2 = "INSERT INTO
			 articulo (nombre_articulo, marca, precio_unidad, cantidad, estado, visitas, descripcion, foto_articulo, id_usuario, id_categoria)
			 VALUES ('$nombreArticulo', '$marca', $precio, 	$cantidad, $condicion, 0, '$descripcion', '$foto', $id, $categoria)";
		 
		 	mysqli_query($conexion, $consulta2);
		    }
	  }

	  $query = "SELECT nombre_articulo, descripcion ,marca, precio_unidad, foto_articulo, cantidad, visitas   				
		          FROM articulo WHERE id_usuario = $id ORDER BY visitas DESC";
	  $result = mysqli_query($conexion, $query);


      $consulta = "SELECT * FROM categoria";
      $result1 = mysqli_query($conexion, $consulta);

	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="uft-8" >    	

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/simplePagination.css">
    
    <link rel="stylesheet" href="css/globals.css">
    <link rel="stylesheet" href="css/historial_venta.css">
	

</head>
<body>
	<header><h1>Mi Historial de Venta</h1></header>
	<p id="home"><a href="index.php">Home</a></p>
	<div class="table-responsive">
		<table cellpadding="5" cellspacing="0">
			<tr colspan="7">
				<td><input type="button" id="btn_Nuevo" name="btn_Nuevo" value="Nuevo Articulo" class="boton" onclick="mostrar('fila');" /></td>
			</tr>
			<tr colspan="7" class="oculto" id="fila">
				<td>
					<img src="img/tienda-virtual.jpg">
					<div>
						<form id="frmRegistro" action="" method="Post" enctype="multipart/form-data">
	 						<table id="tblArticulo" cellpadding="5" cellspacing="0" width="700px" height="400px">
							 	<tr>
							 		<td>Nombre:</td>
							 		<td><input type="Text" id="txtNombre" name="txtNombre" class="textbox" /></td>
							 	</tr>
							 	<tr>
							 		<td>Marca:</td>
							 		<td><input type="Text" id="txtMarca" name="txtMarca" class="textbox" /></td>
							 	</tr>
							 	<tr>
							 		<td>Precio:</td>
							 		<td><input type="Text" id="txtPrecio" name="txtPrecio" class="textbox" /></td>
							 	</tr>
							 	<tr>
							 		<td>Cantidad:</td>
							 		<td><input type="Text" id="txtCantidad" name="txtCantidad" class="textbox"/></td>
							 	</tr>
							 	<tr colspan="2">
							 		<td>Foto de Articulo:</td>
							 		<td><input type="file" id="txtFoto" name="txtFoto" class="boton"/></td>
							 	</tr>
							 	<tr>
							 		<td>Descripcion:</td>
							 		<td><textarea id="txtDescripcion" rows="3" name="txtDescripcion" style="resize:none" class="textArea"></textarea></td>
							 	</tr>
							 	<tr>
							 		<td>Condicion del Articulo:</td>
							 		<td>
							 			<select id="slEstado" name="slEstado" class="Select">
							 			<option value="0">--Seleccionar--</option>
							 			<option value="1">Malisima</option>
							 			<option value="2">Mala</option>
							 			<option value="3">Buena</option>
							 			<option value="4">Muy Buena</option>
							 			<option value="5">Excelente</option>
							 		 	</select>
							 		</td>
							 	</tr>
							 	<tr>
							 		<td>Categoria:</td>
							 		<td>
							 			<select id="slCategoria" name="slCategoria" class="Select">
							 				<option value="0">--Seleccionar--</option>
							 				<?php while($categorias = mysqli_fetch_assoc($result1)){ ?>
							 				<option value="<?php echo $categorias["id"];?>"><?php echo $categorias["nombre_categoria"];?></option>
							 				<?php }?>
							 			</select>
							 		</td>
							 	</tr>
							 	<tr colspan= "2" align="left">
							 		<td></td>
							 		<td><input  id="sbRegistrar" type="submit" value="Registrar" name="dbRegistrar" class="boton" /></td>
							 	</tr>
							</table>
	                    </form>
					</div>
				</td>
				<td></td>
			</tr>
		</table>
		
	</div>

	<br/>
	<br/>
	<div class="table-responsive">
		<table cellpadding="5" cellspacing="5" class="table">
			<tr>
				<th>Foto</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>marca</th>
				<th>Precio unidad</th>
				<th>Cantidad</th>
				<th>Visitas</th>
			</tr>
			<?php while($row = mysqli_fetch_assoc($result)) { ?>		
				<tr>
					<td><img src="<?php echo "articulos/".$row['foto_articulo']; ?>" style="width:100px; height:100px" /></td>
					<td><p><?php echo $row["nombre_articulo"]; ?></p></td>
					<td><p><?php echo $row["descripcion"]; ?></p></td>
					<td><p><?php echo $row["marca"]; ?></p></td>
					<td><p><?php echo "L. ".$row["precio_unidad"];?></p></td>
					<td><p><?php echo $row["cantidad"];?></p></td>
					<td><p><?php echo $row["visitas"];?></p></td>
				</tr>
									
			<?php  } mysqli_free_result($result);	 ?>
		</table>

	</div>
	

	<script type="text/javascript">

	function mostrar(id){

		var fila = document.getElementById(id);

		fila.style.display = (fila.style.display == 'none') ? 'block' : 'none';
	}
	</script>

</body>
</html>