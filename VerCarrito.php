<?php 
	require_once("clases/Articulo.php");
	require_once("clases/Categoria.php");
	require_once("clases/Usuario.php");
 	session_start();

 	$articulo = new Articulo();
 	$categoria = new Categoria();
 	$usuario = new Usuario();

 	if(isset($_GET['id']))
 	{
 		if(isset($_SESSION['carro']))
 		{
 			unset($_SESSION['carro'][$_GET['id']]);
 		}
 	}
	if(isset($_GET["text"]))
	{
		$texto = $_GET["text"];
		$result = $articulo->BuscarArticulosSinCategoria($texto);
	}
	else
	{
		$texto = "";
		$result = $articulo->BuscarTodosArticulos();
	}

	$result2 = $categoria->ObtenerCategorias();
  
  if(isset($_SESSION["usuario_valido"]))
  {
    $id = $_SESSION["usuario_valido"];
    $user = $usuario->ObtenerUsuario($id);
    $rowUser = mysqli_fetch_assoc($user);
  }	
  $total = 0;
  if(isset($_SESSION['carro']))
  {
  	$carrito = $_SESSION['carro'];
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Carrito de compras</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/globals.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/ver_carrito.css">

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min-1.10.3.js"></script>
    <script src="js/simplePagination.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/globals.js"></script>   
</head>
<body>
	<?php require_once("header.php"); ?>

	<div id="father_content">
		<div id="articles">
		<?php if(isset($carrito))
			foreach ($carrito as $key => $value) { ?>		
				<div class="article">
					<div class="details">
						<div>
							<img src="<?php echo "articulos/".$value['imagen']; ?>" />
							<p>Existencia: <?php echo $value["existencia"]; ?></p>
						</div>
						<div>
							<p style="color:blue;"><?php echo $value["nombre"]; ?></p>	
							<p><?php echo $value["descripcion"]; ?></p>
						</div>
					</div>
					<div class="quantity">
						<p style="color:red;">Precio : <?php echo "L. ".$value["precio"] ?></p>
						<p><label>Cantidad: </label><input type="number" name="<?php echo $key; ?>" min="1" max="<?php echo $value["existencia"]; ?>" class="txtCantidad" value="<?php echo $value["cantidad"]; ?>" /></p>
						<p>&nbsp</p>
						<a class="delete" value="<?php echo $key; ?>" href="#">Eliminar</a>
					</div>
					
				</div>
		<?php $total = $total + $value["precio"];	}	 ?>
		<div id="total"><p>Total L. <?php echo $total; ?></p></div>
		</div>
		<div id="logo_shop">
			<img  src="img/green.png">
			<?php if($total > 0) { ?>
			<p>Esta listo para efectuar su compra?</p>
			<p><a id="buyNow" href="#">&iexcl;Comprar Ahora!</a></p>
			<?php } else { ?>
			<p>No tienes ningun articulo en tu carrito</p>
			<?php } ?>
		</div>
		<div class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h4 class="modal-title">Modal title</h4>
		      </div>
		      <div class="modal-body">
		        <p>One fine body…</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div class="ventana" title="Debes logearte">
			<div><input name="txtUsuario" class="txtUsuario" placeholder="correo electronico" /><a class="in" href="#">Entrar</a></div>
			<div><input type="password" name="txtContra" class="txtContra" placeholder="contraseña" /></div>
			<div><p>Eres nuevo?<a class="new" href="registro_usuario.php">Registrate</a></p></div>
		</div>
	</div>

</body>
</html>