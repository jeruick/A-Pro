<?php
	require_once("conexion.php");
	if(isset($_GET["text"]))
	{
		$texto = $_GET["text"];
		$result = mysqli_query($conexion, "SELECT * FROM articulo WHERE nombre_articulo LIKE '%$texto%'");
	}
	else
	{
		$texto = "Mostrar Productos";
		$result = mysqli_query($conexion, "SELECT * FROM articulo");
	}

	$result2 = mysqli_query($conexion, "SELECT * FROM categoria");
  	
	
?>

<html>
<head>
	<title><?php echo $texto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   	
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estiloLogin.css" />
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/globals.css">

    <script src="js/jquery.js"></script>
    <script src="js/simplePagination.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/globals.js"></script>   

    <style type="text/css">
        #contenido
        {
          border: 4px solid white;
          border-radius: 20px;
          box-shadow: #000 0px 0px 3px;
          margin: 1em auto;
          width: 80%;
        }
        .col1
        {
          width: 70%;
        }
        .col1, .col2
        {
          display: inline-block;
          vertical-align: top;
        }
        .col2
        {
          width: 25%;
        }
        .col2 p 
        {
          margin-bottom: 15px;
        }
        #selector
        {
        	width: 50%;
        }

        #selector ul 
        {
        	margin: 0 auto;
        	width: 70%;
        }
        .articles
        {
            margin-top: 1em;
            width: 100%;
        }
        .article_photo
        {
            width: 20%;
        }
        .article_photo img 
        {
          width: 150px;
        }
        .buyNow
        {
          background: #66CD00;
          color: white;
          padding: 5px 12px; 
          text-decoration: none;
        }
        .buyNow:hover
        {
          background: #66AA00;
          color: white;
          text-decoration: none;
        }
        .detalles
        {
          border-left: 1px solid rgba(0,0,0,0.3);
          border-bottom: 1px solid rgba(0,0,0,0.3);
          padding-left: 1em;
          width: 75%;
        }

        .detalles .addCart
        {
          background: #E57300;
          color: white;
          padding: 5px 10px; 
          text-decoration: none;
        }

        .detalles, .article_photo
        {
          display: inline-block;
          vertical-align: top;
        }
  	
        .dropdown
        {
          width: 50%;
        }

        @media screen and (max-width: 1024px)
        {
          
         	#selector
         	{
         		width: 100%;
         	}

    	    #selector ul 
    	    {
    	    	margin: 0 auto;
    	    	width: 40%;
    	    }

        }

	</style>
	<script>
  
		$(document).ready(function()
		{  				
			var items = $("#contenido .articles");

	    	var numItems = items.length;
	    	var itemsxPage = 10;

        if(numItems > 0)
        {
  	    // only show the first 2 (or "first per_page") items initially
  	    	items.slice(itemsxPage).hide();

  	    	$("#selector").pagination({
  	        items: numItems,
  	        itemsOnPage: itemsxPage,
  	        cssStyle: 'light-theme',
  	        onPageClick: function(pageNumber) { // this is where the magic happens
  	            // someone changed page, lets hide/show trs appropriately
  	            var showFrom = itemsxPage * (pageNumber - 1);
  	            var showTo = showFrom + itemsxPage;

  	            items.hide().slice(showFrom, showTo).show();
  	                 // first hide everything, then show for the new page
  	        }	
     			});
         
        }
         else{ $("#contenido").html("No se encontraron resultados");}
		});
	</script>   
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
                <button id="searchButton"  class="btn btn-default" type="submit" style="height:40px;"><img src="icons/search.png"></button>
              </span>
              <div id="coincidencias"></div>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          </form>
      </div><!-- /.row -->

      <div class="container">
        
        <section class="main">
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
      </div>
      <div id="shopping_cart"><p style="padding-left:10px; margin: 0;position:relative; top: 12px;">0</p><a href="#" style="margin: 0;padding:0;"><img src="icons/cart.png"></a></div>
  </div>
  

	<div id="contenido">
		<?php while($row = mysqli_fetch_assoc($result)) { ?>
		<div class="articles">
			<div class="article_photo">
				<img src="<?php echo 'articulos/'.$row["foto_articulo"]; ?>">
			</div>
			<div class="detalles">
        <div class="col1">
          <p><span style="color:#00008B;font-size: 14px;font-weight:bold;"><?php echo $row["nombre_articulo"]; ?></span></p>
          <p>Precio: <span style="color: red;"><?php echo "L.".$row["precio_unidad"]; ?></span></p>
          <p>Marca: <span><?php echo $row["marca"]; ?></span></p>
          <p>Cantidad: <span><?php echo $row["cantidad"]; ?></span></p>
          <p><?php echo $row["descripcion"]; ?></p>
        </div>
        <div class="col2">
          <p>Estado: <span><img style="padding-bottom:5px;" src="<?php echo "icons/".$row["estado"]."star.png"; ?>"></span></p>
          <p><a class="addCart" href="#" value="<?php echo $row["id"]; ?>">Agregar al carro</a></p>
          <p><a class="buyNow" href="#">Comprar Ahora</a></p>
        </div>        
			</div>
		</div>
		<?php } mysqli_free_result($result); ?>
	</div>
	<center><div id="selector"></div></center>
</body>
</html>