<?php 
  session_start();
  require_once("conexion.php");
  $result = mysqli_query($conexion, "SELECT * FROM categoria");
  $result2 = mysqli_query($conexion, "SELECT * FROM categoria");

  if(isset($_SESSION["usuario_valido"]))
  {
    $id = $_SESSION["usuario_valido"];
    $user = mysqli_query($conexion, "SELECT * FROM usuario WHERE id = $id");
    $rowUser = mysqli_fetch_assoc($user);
  }

  $consulta = "SELECT T1.id, T1.nombre_articulo, T1.foto_articulo, T1.visitas, T1.id_categoria, 
          T1.marca,T1.precio_unidad, T2.nombre_categoria FROM 
((SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 1 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 2  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION 
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 3  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 4  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 5  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 6  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 7  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 8  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 9  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5 ) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 10 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION 
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 11 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 12 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
(SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 13 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5)) AS T1,
(SELECT id_categoria, nombre_categoria FROM ARTICULO, CATEGORIA WHERE ARTICULO.ID_CATEGORIA = CATEGORIA.ID
GROUP BY ID_CATEGORIA ORDER BY SUM(VISITAS) DESC LIMIT 5 ) AS T2 WHERE T1.ID_CATEGORIA = T2.ID_CATEGORIA";
$resultado = mysqli_query($conexion, $consulta);
$i = 5;

?>
<!DOCTYPE html>
<html lang="es">
<head>
	 <title>APro Tienda en line Electronica| Moda |Deportes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estiloLogin.css" />
    <link rel="stylesheet" href="css/globals.css">
    <style type="text/css">
  .addCart
    {
        background: #E57300;
        color: white;
        font-size: 12px;
        padding: 5px 5px; 
        text-decoration: none;
    }
    .addCart:hover
    {
      color: white;
      text-decoration: none;
    }
  .details_article
  {
    width: 90px;
  }
  .details_article, .photo_article
  {
    display: inline-block;
    vertical-align: top;
  }

  .top_articles
  {
    background: rgb(250,250,250);
    border-bottom: 1px solid rgba(0,0,0,0.2);
    border-right: 1px solid rgba(0,0,0,0.2);
    display: inline-block;
    height: 170px;
    margin-top: 10px;
    margin-left: 5px;
    width: 170px;
  }
  .top_articles img
  {
    height: 80px;
    margin: 0 auto;
    width: 80px;
  } 
  .top_articles p 
  {
    font-size: 10px;
  }
  @media screen and (max-width: 1024px)
  {
    .top_articles
    {
      height: 150px;
      margin-top: 10px;
      margin-left: 0px;
      width: 120px;
    }
     .top_articles img
    {
      height: 50px;
      margin: 0 auto;
      width: 50px;
    } 
    .top_articles p 
    {
      font-size: 8px;
    }
  }
  }
</style>
    
    <script src="js/jquery.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>
	 <script src="js/globals.js"></script>   
</head>
<body>

	<div id="bar">
        <div id="logo">
            <a href="index.php"><img src="images/logo.png"></a>
        </div>
        
        <div class="dropdown">
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
              <input type="text" name="text" class="form-control" style="width:400px;" autocomplete="off">
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
          <?php if(isset($rowUser)) 
          { 
          ?>
            <div class="dropdown-user">
              <a class="account" onClick="mostrarMenuUsuario(this)"><a id="userPhoto" href="#" style="position:relative; top: -20px;"><img src="<?php echo 'foto_perfil/'.$rowUser["foto_usuario"]; ?>" style="border-radius: 50%;width:50px;height:50px;" /></a></a>
              <div class="submenu" style="display: none;">
                <ul class="root">     
                    <li><a class="perfil" href="#" >Perfil</a></li>
                    <li><a class="historial" href="#">Historial</a></li>
                    <li><a class="misArticulos" href="#">Mis Articulos</a></li>
                    <li><a class="logout" href="#">Logout</a></li>
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
  

	<div id="contenedor" >
	    <div id="myCarousel" class="carousel slide" style="width:80%; margin: 0 auto;">
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
          <div class="item"><img  src="publicity/men.png" alt="banner7"></div>
	        <div class="item"><img  src="publicity/girls.jpg" alt="banner7"></div>
	      </div>
	      <!-- Carousel nav -->
	      <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	      <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	    </div>
	</div>

  <div id="categorias">
    <ul>
      <?php while ($row = mysqli_fetch_assoc($result))
       {
      ?>
          <li value='<?php echo $row["id"]; ?>'><?php echo $row["nombre_categoria"]; ?></li>  
      <?php 
       } mysqli_free_result($result);
       ?>
      
    </ul>
  </div>

  <div id="articulos-mas-vistos">
    
      
      <?php while($row = mysqli_fetch_assoc($resultado)){ 
            if(($i%5 == 0)){  ?>
              <div  class="articulos-categoria">          
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

</body>
</html>