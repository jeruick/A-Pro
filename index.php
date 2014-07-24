<?php
	$conexion = mysqli_connect("localhost","root","","articulo");
	$result = mysqli_query($conexion, "SELECT * FROM articulo");
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Apro Tecnologia| Deportes| Ropa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="css/misestilos.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/user_dropdown.css" />
    <link rel="stylesheet" type="text/css" href="css/simplePagination.css" />
    <script src="js/jquery.js"></script>
    <script src="js/chosen.jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.simplePagination.js"></script>
    <script src="js/login.js"></script>
    <script src="js/user_dropdown.js"></script>
	<script>
	
	$(document).ready(function($) {
		var items = $("#contenido .articles div");

    	var numItems = items.length;
    	var itemsxPage = 10;

    // only show the first 2 (or "first per_page") items initially
    	items.slice(itemsxPage).hide();

    	jQuery("#selector").pagination({
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

    var config = {
              '.chosen-select'           : {},
              '.chosen-select-deselect'  : {allow_single_deselect:true},
              '.chosen-select-no-single' : {disable_search_threshold:10},
              '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
              '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            } 
 
	});


 	</script>
</head>
<body>
	<div id="bar">
        <div id="logo">
            <a href="index.php"><img src="images/logo.png"></a>
        </div>
        <div id="buscar">
            <label style="">Buscar:</label>
            <input id="txtBuscar" name="txtBuscar" type="search">
            <a id="searchbutton" href="#"><img src="icons/search.png"></a>
            
           <select data-placeholder="Elige una categoria..." class="chosen-select" style="width:200px;" tabindex="2">
            <option value=""></option>
            <option value="celulares">Celulares</option>
            <option value="tablets">Tablets</option>
            <option value="computadoras">Computadoras</option>
            <option value="ropa">Ropa</option>
            <option value="laptops">Laptos</option>
            <option value="automoviles">Automoviles</option>
            <option value="libros">Libros</option>
            <option value="accesorios">Accesorios</option>
          </select>
        </div>
        <div id="shopping">
            <a href="#"><img src="images/cart3.png"></a>
        </div>
        <div id="container">
            <!-- Login Starts Here -->
            <div id="loginContainer">
                <a href="#" id="loginButton"><span>Login</span><em></em></a>
                <div style="clear:both"></div>
                <div id="loginBox">                
                    <form id="loginForm" method="get">
                        <fieldset id="body">
                            <fieldset>
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" />
                            </fieldset>
                            <fieldset>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" />
                            </fieldset>
                            <input type="submit" id="login" value="Sign in" />
                            <label for="checkbox"><input type="checkbox" id="checkbox" />Remember me</label>
                        </fieldset>
                        <span><a href="#">Forgot your password?</a></span>
                    </form>
                </div>
            </div>
            <!-- Login Ends Here -->
		</div>
        
    </div>

	<div id="contenido">
		<?php while($row = mysqli_fetch_assoc($result)) { ?>
		<div class="articles">
			<div class="article_photo">
				<img src="<?php echo 'Phones/'.$row["foto"]; ?>">
			</div>
			<div class="description">
				<p><?php echo "Precio: L.".$row["precio"]; ?></p>
				<p><?php echo "Descripcion:".$row["descripcion"]; ?></p>
			</div>
		</div>
		<?php } mysqli_free_result($result); ?>
	</div>
	<center><div id="selector"></div></center>
</body>
</html>