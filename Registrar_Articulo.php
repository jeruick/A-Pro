<?php
$conexion = mysqli_connect("localhost","root","","apro"); // HAY QUE CAMBIAR EL NOMBRE DE LA BASE DE DATOS AQUI
//session_start();

//if($_SESSION["id_usuario"]){

$consulta = "SELECT * FROM categoria";
$result = mysqli_query($conexion, $consulta);

if (isset($_POST["txtNombre"])){

	$nombreArticulo = $_POST["txtNombre"];
	$marca = $_POST["txtMarca"];
	$precio = $_POST["txtPrecio"];
	$cantidad = $_POST["txtCantidad"];
	$condicion = $_POST["slEstado"];
	$descripcion = $_POST["txtDescripcion"];
	$categoria = $_POST["slCategoria"];
	$usuario = 1; // *************AQUI VA $_SESSION["id_usuario"] **************
	$foto = $_FILES["txtFoto"]["name"];

	if($_FILES["txtFoto"]["error"] > 0){

		 echo "Error: " . $_FILES["txtFoto"]["error"] . "<br>";
	}
	else{

	move_uploaded_file($_FILES["txtFoto"]["tmp_name"], "Articulos/" . $_FILES["txtFoto"]["name"]);

	$consulta2 = "INSERT INTO
	 articulo(nombre_articulo, marca, precio_unidad, cantidad, estado, visitas, descripcion, foto_articulo, id_usuario, id_categoria)
	 VALUES ('$nombreArticulo', '$marca', $precio, $cantidad, $condicion, 0, '$descripcion', '$foto', $usuario, $categoria)";
 
 	mysqli_query($conexion, $consulta2);
 	}
  } 
//}
//else{
//	header("location: ....."); ERICK PONE LA PAGINA DE INICIO  O EL LOGIN PARA QUE REDIRECCIONE EN CASO DE QUE NO HAYA INICIADO SESION
//}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="ISO-8859-1" > 
	<title>Registro de Articulos</title>
</head>
<body>
<center><header><h1>Registro de Articulos</h1></header>
<form id="frmRegistro" action="" method="Post" enctype="multipart/form-data">
 <table id="tblArticulo" cellspacing="5" cellpadding="2">
 	<tr>
 		<td>Nombre:</td>
 		<td><input type="Text" id="txtNombre" name="txtNombre" /></td>
 	</tr>
 	<tr>
 		<td>Marca:</td>
 		<td><input type="Text" id="txtMarca" name="txtMarca" /></td>
 	</tr>
 	<tr>
 		<td>Precio:</td>
 		<td><input type="Text" id="txtPrecio" name="txtPrecio" /></td>
 	</tr>
 	<tr>
 		<td>Cantidad:</td>
 		<td><input type="Text" id="txtCantidad" name="txtCantidad" /></td>
 	</tr>
 	<tr colspan="2">
 		<td>Foto de Articulo:</td>
 		<td><input type="file" id="txtFoto" name="txtFoto" /></td>
 	</tr>
 	<tr>
 		<td>Descripcion:</td>
 		<td><textarea id="txtDescripcion" rows="3" name="txtDescripcion" style="resize:none" ></textarea></td>
 	</tr>
 	<tr>
 		<td>Condicion del Articulo:</td>
 		<td>
 			<select id="slEstado" name="slEstado">
 			<option value="1">Malisima</option>
 			<option value="2">Mala</option>
 			<option value="3">Buena</option>
 			<option value="4">Muy Buena</option>
 			<option value="5">Excelente</option>
 		 	</select>
 		</td>
 	</tr>
 	<tr>
 		<td>Categoria</td>
 		<td>
 			<select id="slCategoria" name="slCategoria">
 				<?php while($categorias = mysqli_fetch_assoc($result)){ ?>
 				<option value="<?php echo $categorias["id"];?>"><?php echo $categorias["nombre_categoria"];?></option>
 				<?php }?>
 			</select>
 		</td>
 	</tr>
 	<tr colspan= "2" align="left">
 		<td></td>
 		<td><input  id="sbRegistrar" type="submit" value="Registrar" name="dbRegistrar"/></td>
 	</tr>
 </table>
 </form></center>
</body>
</html>
