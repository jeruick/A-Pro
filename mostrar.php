<?php
	$conexion = mysqli_connect("localhost","root","","apro");
	$result = mysqli_query($conexion, "SELECT * FROM articulo");
	
?>

<html>
<head>
	<title>Mostrar Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/estiloLogin.css" />
    <link rel="stylesheet" type="text/css" href="css/simplePagination.css">
    <script src="js/jquery.js"></script>
    <script src="js/simplePagination.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>
    <style type="text/css">
	    body
	    {
	      background: #FFF;
	      font-family: "Open Sans";
	      font-size: 16px;
	    }

	    #bar
	    {
	      background: #F8F8F8;
	      margin-bottom: 2em;
	      box-shadow: 0 2px 2px -2px #000000;
	      width: 100%;
	      
	    }
	    #btnLogin
	    {
	      background: #F8F8F8;
	      border-radius: 5px;
	      color: gray;
	      font-size: 16px;
	      font-family: "Open Sans";
	      padding: 0.5em 1em;
	      text-decoration: none;
	      margin: 0;
	      z-index: -1;
	      box-shadow: 
	      0 0 1px rgba(0, 0, 0, 0.3); 

	    }
	    #btnLogin:hover
	    {
	      background: #73b9e6;
	      color: white; 
	    }
	    #contenido
        {
          border: 4px solid white;
          border-radius: 20px;
          box-shadow: #000 0px 0px 3px;
          margin: 1em auto;
          width: 80%;
        }

	    #logo, .dropdown
	    {
	      display: inline-block;
	      vertical-align: bottom;
	    }    

	    #logo
	    {
	      width: 20%;
	    }
	    
	    #logo img
	    {
	      height: 60px;
	      margin: 1em;
	      width: 200px;
	    }

	    #selector
	    {
	    	width: 50%;
	    }

	    #selector ul 
	    {
	    	margin: 0 auto;
	    	width: 60%;
	    }
	    .articles
        {
            margin-top: 1em;
            width: 100%;
        }
        .article_photo
        {
            border-right: 1px solid gray;
            width: 30%;
        }
        .article_photo img 
        {
          width: 200px;
        }
        .description
        {
            width: 68%;
        }

        .description, .article_photo
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
	      	.form-1
	      	{
	        	width: 90%;
	     	}
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
      		$("#btnLogin").on("click", mostrarForm);
  				
			var items = $("#contenido .articles div");

	    	var numItems = items.length;
	    	var itemsxPage = 5;

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
		});

    function mostrarForm()
    {

      $(".form-1").toggle('slow');
  
    }  
	</script>   
</head>
<body>

	<div id="bar">
        <div id="logo">
            <a href="index.php"><img src="images/logo.png"></a>
        </div>

        <div class="dropdown">
          <div class="col-lg-6">
            <div class="input-group">
              <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="height:40px;">Categoria<span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Moda</a></li>
                  <li><a href="#">Deporte</a></li>
                  <li><a href="#">Tecnologia</a></li>
                  <li class="divider"></li>
                  <li><a href="#
                    ">Todas</a></li>
                </ul>
              </div><!-- /btn-group -->
              <input type="text" class="form-control" style="width:400px;">
              <span class="input-group-btn" style="width:300px;">
                <button class="btn btn-default" type="button" style="height:40px;"><img src="icons/search.png"></button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->

      <div class="container">
        
        <section class="main">
          <a id="btnLogin" href="#">Login</a>
          <form class="form-1">
            <p class="field">
              <input type="text" name="login" placeholder="Username or email">
              <i class="icon-user icon-large"></i>
            </p>
              <p class="field">
                <input type="password" name="password" placeholder="Password">
                <i class="icon-lock icon-large"></i>
            </p>
            <p class="submit">
              <button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
            </p>
          </form>
        </section>
        </div>
  </div>

	<div id="contenido">
		<?php while($row = mysqli_fetch_assoc($result)) { ?>
		<div class="articles">
			<div class="article_photo">
				<img src="<?php echo 'articulos/'.$row["foto_articulo"]; ?>">
			</div>
			<div class="description">
				<p><?php echo "Precio: L.".$row["precio_unidad"]; ?></p>
				<p><?php echo "Descripcion:".$row["descripcion"]; ?></p>
			</div>
		</div>
		<?php } mysqli_free_result($result); ?>
	</div>
	<center><div id="selector"></div></center>
</body>
</html>