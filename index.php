<?php 
  session_start();
  require_once("clases/Categoria.php");
  require_once("clases/ArticuloMapper.php");
  require_once("clases/Usuario.php");

  $categoria = new Categoria();
  $result = $categoria->ObtenerCategorias();
  $result2 = $categoria->ObtenerCategorias();

  if (isset($_POST["email"]) && isset($_POST["password"])) 
  {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $usuario = new Usuario();
    $usuario->LogearUsuario($email, $password);
  } 
  if(isset($_SESSION["usuario_valido"]))
  {
    $id = $_SESSION["usuario_valido"];
    $usuario = new Usuario();
    $user = $usuario->ObtenerUsuario($id);
    $rowUser = mysqli_fetch_assoc($user);
  }
  
$i = 5;

?>
<!DOCTYPE html>
<html lang="es">
<head>
	 <title>APro Tienda en line Electronica| Moda |Deportes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
   
</head>
<body>
  
	<?php require_once("header.php"); ?>

  <div id="contenedor" >
      <div id="myCarousel" class="carousel slide" >
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
          <li data-target="#myCarousel" data-slide-to="4"></li>
          <li data-target="#myCarousel" data-slide-to="5"></li>
          <li data-target="#myCarousel" data-slide-to="6"></li>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
          <div class="active item"><img  src="publicity/buy.png" alt="banner1" /></div>
          <div class="item"><img  src="publicity/cool_phones.png" alt="banner2" /></div>
          <div class="item"><img  src="publicity/shopping_girl.png" alt="banner3" /></div>
          <div class="item"><img  src="publicity/any_phone.png" alt="banner4" /></div>
          <div class="item"><img  src="publicity/Tenis-Nike-HyperShield.jpg" alt="banner5" /></div>
          <div class="item"><img  src="publicity/shopping.png" alt="banner6" /></div>
          <div class="item"><img  src="publicity/lenovo-convertable-miix.jpg" alt="banner7"></div>
          <div class="item"><img  src="publicity/men.jpg" alt="banner8"></div>
          <div class="item"><img  src="publicity/girls.jpg" alt="banner9"></div>
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
      </div>
  </div>
  
  <nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" id="boton-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="categorias">
        <?php while ($row = mysqli_fetch_assoc($result))
       {
      ?>
          <li value='<?php echo $row["id"]; ?>'><a href="#"><?php echo $row["nombre_categoria"]; ?></a></li>  
      <?php 
       } mysqli_free_result($result);
       ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  
  <div id="articulos-mas-vistos"  >
    
      
      <?php while($row = mysqli_fetch_assoc($resultado)){ 
            if(($i%5 == 0)){  ?>
              <div  class="articulos-categoria" >          
                <h4><?php echo $row["nombre_categoria"]; ?></h4>
            <?php  }  ?>
              <div class="top_articles">

                <span class="photo_article"><img src="<?php echo "articulos/".$row["foto_articulo"]; ?>"></span>  
                <p style="color: gray;font-weight:bold;"><?php echo $row["nombre_articulo"]; ?></p>
                <p>Precio: <span style="color: red;"><?php echo "L.".$row["precio_unidad"]; ?></span></p>
                <p><a class="addCart" href="#" value="<?php echo $row["id"]; ?>">Agregar al carro</a></p>
              </div>

      <?php $i++; if($i%5 == 0){ ?> 
            </div>           
              <?php }  } mysqli_free_result($resultado); ?>
      </div>
            
  
  </div>

  <div id="articulos-por-categoria"></div>
  <footer>
    <h3>Apro &copy Derechos Reservados</h3>
  </footer>
  
<?php require("footer.php"); ?>
</body>
</html>