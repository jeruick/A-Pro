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
    <meta charset="ISO-8859-1" > 
   	
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

		.boton { 
		  border: 1px solid #dedede;
		  border-radius: 3px;
		  color: #555;
		  display: inline-block;
		  font: bold 12px/12px HelveticaNeue, Arial;
		  padding: 8px 11px;
		  text-decoration: none;
		}
 
		  .textbox { 
		    background: white; 
		    border: 1px solid #DDD; 
		    border-radius: 5px; 
		    box-shadow: 0 0 5px #DDD inset; 
		    color: #666; 
		    outline: none; 
		    height:25px; 
		    width: 275px; 
		   }

		   .textArea { 
		    background: white; 
		    border: 1px solid #DDD; 
		    border-radius: 5px; 
		    box-shadow: 0 0 5px #DDD inset; 
		    color: #666; 
		    outline: none; 
		    height:60px; 
		    width: 275px; 
		   } 
		 .Select {
				width: 220px;
				position: relative;
			}
			 
		 select {
				width: 100%;
				background: #F3F3F3;
				color: #585757;
				padding: 5px;
				font-size: 13px;
				line-height: 100%;
				border: 1px solid #C1C1C1;
				border-radius: 0;
				height: 30px;
				-webkit-appearance: none;
			}
			 
		 option {
				padding: 10px;
			}

		 .oculto{

		 	display: none;
		 }
	</style>

</head>
<body>
	<header><h1>Mi Historial de Venta</h1></header>
	<p id="home"><a href="index.php">Home</a></p>
	<table cellpadding="5" cellspacing="0" width="700px">
		<tr colspan="7">
			<td><input type="button" id="btn_Nuevo" name="btn_Nuevo" value="Nuevo Articulo" class="boton" onclick="mostrar('fila');" /></td>
		</tr>
		<tr colspan="7" class="oculto" id="fila">
			<td>
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
	<br/>
	<br/>
	<table cellpadding="10" cellspacing="0">
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

	<script type="text/javascript">

	function mostrar(id){

		var fila = document.getElementById(id);

		fila.style.display = (fila.style.display == 'none') ? 'block' : 'none';
	}
	</script>

</body>
</html>