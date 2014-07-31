<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/login-menu.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="css/estiloLogin.css" />
    
    <script src="js/jquery.js"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/bootstrap.js"></script>

	<style type="text/css">
    body
    {
      background: #FFF;
      font-family: "Open Sans";
      font-size: 16px;
    }
	
	h4
	{
		background: rgba(0,100,100,0.5);
		border-radius: 0px;
		color:white;
		margin: 0;
		width: 100%;
	}
    #articulos-mas-vendidos
    {
    width: 80%;
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
    #categorias
    {
      width: 10%;
    }
    #categorias ul 
    {
      background: rgba(0,0,0,0.1);
      border-radius: 10px;
      color:rgba(0,0,0,0.5);
      list-style: none;

    }
    #categorias ul li
    {
      padding: 0.5em 1em;
    
    }
    #categorias ul li:hover
    {
      background: #3f9db8;
      color: white;
      cursor: pointer;
      padding-left: 20px; 
    }
    #categorias, #articulos-mas-vendidos
    {
      display: inline-block;
      vertical-align: top;
    }
    #contenedor
    {
      margin-bottom: 1em;
      width: 100%;
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
    #logo, .dropdown
    {
      display: inline-block;
      vertical-align: bottom;
    }   
    #shopping_cart
    {
      
      position: absolute;
      right: 100px;
      top: 23px;
      width:4%;
    }
    .articulos-categoria
    {
        border-right: 1px solid rgba(0,0,0,0.2);
    	  border-left: 1px solid rgba(0,0,0,0.2);
    	  border-bottom: 1px solid rgba(0,0,0,0.2);
        height: 150px;
        margin: 0 auto;
    	   margin: 10px;
        width: 100%;
    }
    
    .dropdown, #user
    {
      display: inline-block;
      vertical-align: middle;
    }
    .dropdown
    {
      width: 50%;
    }

		.item
		{
			height: 300px;
			margin: 0 auto;
			width: 700px;
			
		}
		.item img
		{
			height: 300px;
			margin: 0 auto;
			width: 600px;
		
		}

    @media screen and (max-width: 1024px)
    {
      .form-1
      {
        width: 90%;
      }
      .main
      {
        position: absolute; /* For the submit button positioning */
        top: -38px;
        right: 20px;
      }
      #categorias
      {
        width: 15%;
      }
      #shopping_cart
      {
        position: absolute;
        right: 50px;
      } 

    }

	</style>
	<script>
  
		$(document).ready(function(){
			$('.myCarousel').carousel({interval: 1000})
      $("#btnLogin").on("click", mostrarForm);
  
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
      <li>Ropa</li>
      <li>Electronica</li>
      <li>Casa</li>
      <li>Belleza</li>
      <li>Maletas</li>
    </ul>
  </div>
  <div id="articulos-mas-vendidos">
    <div id="ropa" class="articulos-categoria"><h4>Ropa y Accesorios</h4></div>
    <div id="electronica" class="articulos-categoria"><h4>Electronica</h4></div>
    <div id="casa" class="articulos-categoria"><h4>Casa y Jardin</h4></div>
    <div id="belleza" class="articulos-categoria"><h4>Salud y Belleza</h4></div>
    <div id="maletas" class="articulos-categoria"><h4>Viajes</h4></div>
  </div>

</body>
</html>