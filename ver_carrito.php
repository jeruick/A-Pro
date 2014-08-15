<?php 
	require_once("conexion.php");
 	session_start();
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
		$result = mysqli_query($conexion, "SELECT * FROM articulo WHERE nombre_articulo LIKE '%$texto%'");
	}
	else
	{
		$texto = "";
		$result = mysqli_query($conexion, "SELECT * FROM articulo");
	}

	$result2 = mysqli_query($conexion, "SELECT * FROM categoria");
  
  if(isset($_SESSION["usuario_valido"]))
  {
    $id = $_SESSION["usuario_valido"];
    $user = mysqli_query($conexion, "SELECT * FROM usuario WHERE id = $id");
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estiloLogin.css" />
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/globals.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <style type="text/css">
		.article
		{
			border-top: 1px solid rgba(0,0,0,0.2);
			margin: 10px 0 0 10px;
			padding-top: 10px;
			width: 80%;
		}
		
		.details
		{
			width: 70%;
		}
		.details img 
		{
			box-shadow: rgba(0,0,0,0.1) 0px 0px 10px;
			width: 100px;
			height: 100px;
		}
		.details div 
		{
			display: inline-block;
			vertical-align: top;
			width: 40%;
		}
	
		.quantity
		{
			width: 20%;
		}
		.quantity .delete
		{
			background: #FF3F3F;
			color: rgb(250,250,250);
			padding: 5px;
			text-decoration: none;
		}
		.quantity input 
		{
			width: 80px;
		}
		.quantity, .details
		{
			display: inline-block;
			vertical-align: top;
		}

		.ventana
		{
			display: none; <!-- es importante ocultar las ventanas previamente -->
			font-family:Arial, Helvetica, sans-serif;
			color:#808080;
			line-height:28px;
			font-size:15px;
			text-align:justify;
		}
		.ventana div 
		{
			margin-bottom: 5px;	
		}
		.ventana input
		{
			width: 250px;	
		}
		#articles
		{
			width: 80%;
		}
		#buyNow
		{
			background: rgb(0,200,100);
			color: white;
			padding: 5px 10px;
			text-decoration: none;
		}
		#buyNow:hover
		{
			background: rgb(0,150,150);
		}
		
		#father_content
		{
			margin-top: 0em;
		}
		#logo_shop
		{
			
			width: 18%;
		}
		#logo_shop, #articles
		{
			display: inline-block;
			vertical-align: top;
		}
		.ventana .in 
		{
			background: #73b2e6;
			color:white;
			margin-left: 5px;
			padding: 5px 10px;
			text-decoration: none;
		}
		.ventana .new 
		{
			background: rgb(0,200,100);
			color:white;
			margin-left: 5px;
			padding: 5px 10px;
			text-decoration: none;
		}
		
		#total
		{
			border-top: 1px solid rgba(0,0,0,0.2);
			width: 80%;
		}
		#total p 
		{
			color: red;
			font-family: Times;	
			font-size: 22px;
			text-align: right;
			width: 85%;
		}
    </style>

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min-1.10.3.js"></script>
    <script src="js/simplePagination.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/globals.js"></script>   
</head>
<body>
	<div id="bar">
        <div id="logo">
            <a href="index.php"><img src="images/logo.png"></a>
        </div>
        
        <div class="dropdown" style="margin-bottom:5px;">
          <form id="form1" name="form1" action="mostrar.php" method="GET">
          <div class="col-lg-6">
            <div class="input-group">
              <div class="input-group-btn">
                <button type="button" id="catSeleccionada" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="height:40px;width: 150px;font-size:10px;">Categorias<span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                  <?php while($row = mysqli_fetch_assoc($result2))
                  {
                  ?>
                    <li id='<?php echo $row["id"]; ?>' style="font-size: 10px;"><a href="#"><?php echo $row["nombre_categoria"]; ?></a></li>    
                  <?php  
                  } mysqli_free_result($result2) ?>
                  <li class="divider"></li>
                  <li><a href="#">Todas</a></li>
                </ul>
              </div><!-- /btn-group -->
              <input type="text" name="text" class="form-control" style="width:400px;" autocomplete="off" value="<?php echo $texto; ?>">
              <span class="input-group-btn" style="width:100px;">
                <button id="searchButton" name="cat" class="btn btn-default" type="submit" style="height:40px;"><img src="icons/search.png"></button>
              </span>
              <div id="coincidencias"></div>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          </form>
      </div><!-- /.row -->

      <div class="container">
        <section class="main">
          <?php if(isset($rowUser)) 
          { 
          ?>
            <div class="dropdown-user">
              <a class="account" onClick="mostrarMenuUsuario(this)"><a id="userPhoto" href="#" style="position:relative; top: -20px;"><img src="<?php echo 'foto_perfil/'.$rowUser["foto_usuario"]; ?>" style="border-radius: 50%;width:50px;height:50px;" /></a></a>
              <div class="submenu" style="display: none;">
                <ul class="root">     
				  <?php if($rowUser["admin"] == "1") { ?>   
                    <li><a class="perfil">Perfil</a></li>
                    <li><a class="usuarios">Usuarios</a></li>
                    <li><a class="logout" >Logout</a></li>
                  <?php }else{  ?>
                    <li><a class="perfil">Perfil</a></li>
                    <li><a class="historial" >Historial</a></li>
                    <li><a class="misArticulos" >Mis Articulos</a></li>
                    <li><a class="logout" >Logout</a></li>
                  <?php } ?>
                  </ul>
              </div>
            </div> 
          <?php   
          } else {  ?>
          <span id="spLogin"><a id="btnLogin" href="#">Login</a><span>
          <form class="form-1" action="">
            <p class="field">
              <input type="text" id="txtUser" name="login" placeholder="Username or email">
              <i class="icon-user icon-large"></i>
            </p>
              <p class="field">
                <input type="password" id="txtPass" name="password" placeholder="Password">
                <i class="icon-lock icon-large"></i>
            </p>
           <p class="campo">
                <a href="registro_usuario.php" id="btnRegistrar" name="btnRegistrar">Registrarse</a>
            </p>
            <p class="submit1">
              <button type="button" id="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
            </p>  
          </form>
        </section>
        <?php } ?>
      </div>

      <div id="shopping_cart"><p style="padding-left:10px; margin: 0;position:relative; top: 12px;">0</p><a href="#" style="margin: 0;padding:0;"><img src="icons/cart.png"></a></div>
  	</div>

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
			<img style="width:90%;" src="img/green.png">
			<?php if($total > 0) { ?>
			<p>Esta listo para efectuar su compra?</p>
			<p><a id="buyNow" href="#">¡Comprar Ahora!</a></p>
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