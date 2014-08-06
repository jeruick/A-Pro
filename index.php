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
                    <li><a href="#Perfil" >Perfil</a></li>
                    <li><a href="#Historial">Historial</a></li>
                    <li><a href="#misArticulos">Mis Articulos</a></li>
                    <li><a id="logout" href="#Logout">Logout</a></li>
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
          <li id='<?php echo $row["id"]; ?>'><?php echo $row["nombre_categoria"]; ?></li>  
      <?php 
       } mysqli_free_result($result);
       ?>
      
    </ul>
  </div>
  <div id="articulos-mas-vendidos">
    <div id="ropa" class="articulos-categoria"><h4>Ropa y Accesorios</h4></div>
    <div id="electronica" class="articulos-categoria"><h4>Electronica</h4></div>
    <div id="casa" class="articulos-categoria"><h4>Casa y Jardin</h4></div>
    <div id="belleza" class="articulos-categoria"><h4>Salud y Belleza</h4></div>
    <div id="maletas" class="articulos-categoria"><h4>Viajes</h4></div>
  </div>

  <div class="dropdown-user">
      <a class="account" ><span>My Cuenta</span></a>
      <div class="submenu" style="display: none; ">
          <ul class="root">     
            <li><a href="#Perfil" >Perfil</a></li>
            <li><a href="#Historial">Historial</a></li>
            <li><a href="#misArticulos">Mis Articulos</a></li>
            <li><a href="#logout">Logout</a></li>
          </ul>
      </div>
  </div>


</body>
</html>