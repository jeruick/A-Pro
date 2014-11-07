<header>

    <div id="bar" class="row">
        <div id="logo" class="col-xs-12 col-md-2">
            <a href="index.php"><img src="images/logo2.png"></a>
        </div>
        
        <div class="col-md-6 col-xs-12" >
          <div class="dropdown" id="buscar-control">
            <form id="form1" class="form" name="form1" action="MostrarResultados.php" method="GET">
              
                <div class="input-group" style="margin: 0" >
                  <div class="input-group-btn">
                    <button type="button" id="catSeleccionada" class="btn btn-default dropdown-toggle" data-toggle="dropdown">        Categorias<span class="caret"></span>
                    </button>
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
                  <input type="text" name="text" id="txtBusqueda" class="form-control" autocomplete="off">
                  <span class="input-group-btn" >
                  <button id="searchButton" name="cat" class="btn btn-default" type="submit" ><img src="icons/search.png"></button>
                  </span>
                  <div id="coincidencias"></div>
                </div>
              
            </form>
        </div>
      </div>
      <div class="col-xs-2  col-md-1 pull-left" id="shopping_cart">
          <button class="btn btn-primary" type="button">
              <a href="#" ><img src="icons/carrito.png"></a><span class="badge">0</span>
          </button>
        
      </div>
      <div class="col-xs-6 col-md-2  pull-right">
        <?php if(!isset($_SESSION["usuario_valido"])) 
        {
          echo <<<"EOT"

        <button type="button" id="btnLogin" class="btn btn-default pull-right">
          <span class="glyphicon glyphicon-align-center"></span> Usuarios</button>
        <div class="login"> 
          <form class="form-signin" role="form" id="login" name="login" action="#" method="post">
            <input type="email" class="form-control"  name="email" id="email" placeholder="Email" required>
            <input type="password" class="form-control"  name="password" id="password" placeholder="Password" required>
            <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Ingresar</button>  
            <a href="" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span>Registrar</a>
          </form>
        </div>
EOT;
        }
        else
        {

          echo <<<"EL"

          <div class="dropdown-user">
          <a class="account" >
            <span><a id="userPhoto" href="#" ><img src='foto_perfil/{$rowUser["foto_usuario"]}'  /></a></span></a>
          <div class="submenu">
            <ul class="root">     
EL;
          if($rowUser["admin"] == "1") 
          { 
            echo <<<"EOT"
                    <li><a onClick="mostrarPerfil()" class="perfil">Perfil</a></li>
                    <li><a onClick="listarUsuarios()" class="usuarios">Usuarios</a></li>
                    <li><a onClick="logout()" class="logout" >Logout</a></li>
EOT;
          }else
          { 
            echo <<<"EL"
                    <li><a onClick="mostrarPerfil()" class="perfil">Perfil</a></li>
                    <li><a onClick="mostrarHistorial()" class="historial" >Historial</a></li>
                    <li><a onClick="misArticulos()" class="misArticulos" >Mis Articulos</a></li>
                    <li><a onClick="logout()" class="logout" >Logout</a></li>
EL;
          } 

        }
      ?>
              </ul>
          </div>
        </div>
    
      </div>
    </div>


</header>