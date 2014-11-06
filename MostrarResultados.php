<?php
	require_once("clases/Articulo.php");
  require_once("clases/Categoria.php");
  require_once("clases/Usuario.php");
  session_start();
  $nombre_categoria = "Categorias";
  $articulo = new Articulo();
  $category = new Categoria();

	if(isset($_GET["text"]) && isset($_GET["cat"]))
	{
      if(!empty($_GET["cat"]))
      {
        $texto = $_GET["text"];
        $categoria = $_GET["cat"];
        
        $result = $articulo->BuscarArticulos($texto, $articulo);
        
        while ($article = mysqli_fetch_assoc($result))
        {
          $id_articulo = $article["id"];
          $articulo->AumentarVisitaArticulo($id_articulo);
        }
        mysqli_data_seek($result, 0);         
        
        $resultCat = $category->BuscarCategoria($categoria);
        $fetch = mysqli_fetch_assoc($resultCat);
        $nombre_categoria = $fetch["nombre_categoria"];
      }
      else
      {
        $texto = $_GET["text"];
        $result = $articulo->BuscarArticulosSinCategoria($texto);
        
        while ($article = mysqli_fetch_assoc($result))
        {
          $id_articulo = $article["id"];
          $articulo->AumentarVisitaArticulo($id_articulo);
        }
        mysqli_data_seek($result, 0);
      }  
      
	}

	else
  {
		$texto = "Mostrar Productos";
		$result = $articulo->BuscarTodosArticulos();
	}

	$result2 = $category->ObtenerCategorias();
  
  if(isset($_SESSION["usuario_valido"]))
  {
    $id = $_SESSION["usuario_valido"];
    $usuario = new Usuario();
    $user = $usuario->ObtenerUsuario($id);
    $rowUser = mysqli_fetch_assoc($user);
  }	
?>

<html>
<head>
	<title><?php echo $texto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/globals.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/mostrar_resultados.css">
    

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min-1.10.3.js"></script>
    <script src="js/simplePagination.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/globals.js"></script>   
</head>
<body>
  <?php require_once("header.php"); ?>
	
	<div id="contenido">
<?php 
    while($row = mysqli_fetch_assoc($result)) 
    {
    echo <<<"EOT"
		<div class="articles">
			<div class="article_photo">
				<img src="articulos/{$row["foto_articulo"]}">
			</div>
			<div class="detalles">
        <div class="detalles-col-1">
          <p><span style="color:#00008B;font-size: 14px;font-weight:bold;">{$row["nombre_articulo"]}</span></p>
          <p>Precio: <span style="color: red;">{$row["precio_unidad"]}</span></p>
          <p>Marca: <span>{$row["marca"]}</span></p>
          <p>Existencia: <span>{$row["cantidad"]}</span></p>
          <p>{$row["descripcion"]}</p>
        </div>
        <div class="detalles-col-2">
          <p>Estado: <span><img style="padding-bottom:5px;" src='icons/{$row["estado"]}star.png'></span></p>
          <p>Cantidad: <input type="number" min="1" max="{$row["cantidad"]}" style="width:50px" value="1" name="{$row["id"]}"></p>
          <p><a class="addCart" href="#" value="{$row["id"]}">Agregar al carro</a></p>
          <p><a class="buyNow" href="#" value="{$row["id"]}">Comprar Ahora</a></p>
        </div>        
			</div>
		</div>
EOT;
		} mysqli_free_result($result);
?>
	</div>
	<center><div id="selector"></div></center>
  
  <div class="ventana" title="Debes logearte">
      <div><input name="txtUsuario" class="txtUsuario" placeholder="correo electronico" /><a class="in" href="#">Entrar</a></div>
      <div><input type="password" name="txtContra" class="txtContra" placeholder="contraseña" /></div>
      <div><p>Eres nuevo?<a class="new" href="registro_usuario.php">Registrate</a></p></div>
  </div>

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
</body>
</html>