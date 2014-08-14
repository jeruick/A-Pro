<?php
require_once("conexion.php");
session_start();
if(isset($_SESSION["usuario_valido"]))
{

	$id = $_SESSION["usuario_valido"];  

	// ACTUALIZACION DE PERFIL
if(isset($_POST["txtNombre"]))
{

		$nombre = $_POST["txtNombre"];
		$fecha_nac = $_POST["txtFecha"];
		$correo = $_POST["txtCorreo"];
		$genero = $_POST["sex"];
		$numero_t = $_POST["txtNumeroT"];
		$ciudad = $_POST["Slciudad"];
		$prueba = strtotime($fecha_nac);

		$nacimiento = date("Y-m-d", $prueba);
	
		// SI ACTUALIZA FOTO 
	    if($_FILES["txtFoto"]["name"] != "")
	    {
			$foto = $_FILES["txtFoto"]["name"];

			move_uploaded_file($_FILES["txtFoto"]["tmp_name"], "foto_perfil/". $_FILES["txtFoto"]["name"]);

			$query = "UPDATE usuario SET nombre_usuario = '$nombre', fecha_nacimiento = '$nacimiento', sexo='$genero', numero_telefonico = '$numero_t',
						correo_electronico ='$correo', foto_usuario ='$foto', id_ciudad = $ciudad WHERE id= $id";
		    mysqli_query($conexion, $query);		    	 
	    }
	    else if($_FILES["txtFoto"]["name"] == "")
	    {
	    	$query = "UPDATE usuario SET nombre_usuario = '$nombre', fecha_nacimiento = '$nacimiento', sexo='$genero', numero_telefonico = '$numero_t',
						correo_electronico='$correo', id_ciudad= $ciudad WHERE id= $id";

			mysqli_query($conexion, $query);
	    }
}

// ACTUALIZACION DE CONTRASENA
       if(isset($_POST["txtPass_nueva"]) && isset($_POST["txtConfirmar_pass"]))
       { 
       		$texto1 = $_POST["txtPass_nueva"];
		 	$texto2 = $_POST["txtConfirmar_pass"];
 
		   if($texto1 == $texto2)
   			{
 				$pass = md5($_POST["txtConfirmar_pass"]);

				$consultaPass = "UPDATE usuario SET contrasena = '$pass' WHERE id= $id"; 
				mysqli_query($conexion, $consultaPass);
   	        }
        }

   $consulta = "SELECT nombre_usuario, fecha_nacimiento, sexo, numero_telefonico, foto_usuario,
				correo_electronico, nombre_ciudad, nombre_pais, id_pais, id_ciudad
				FROM usuario, ciudad, pais 
				WHERE usuario.id = $id AND usuario.id_ciudad = ciudad.id AND ciudad.id_pais = pais.id";

	$result = mysqli_query($conexion, $consulta);


}
else{

	header("location: index.php");
}
$consulta2 = "SELECT * FROM pais";
$consulta3 = "SELECT * FROM ciudad";
$result2 = mysqli_query($conexion, $consulta2);
$result3= mysqli_query($conexion,$consulta3);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8"> 
  <link rel="stylesheet" href="css/globals.css">
	<style type="text/css">
    body
    {
      background: rgba(0,0,0,0.1); 
      margin: 0;
      padding: 0;
    }
    div
    {

      margin: 0;
      border: 0;
      padding: 0;
    }
    footer
    {
      background: rgba(0,0,0,0.7);
      bottom:0;
      left: 0;
      position: fixed;
      padding: 1em;
      width: 100%;

    }
    header
    {
      background: #6AC0EF;
    
    }
    input[type=text],input[type=password]
      {
      border: 1px solid #DBE1EB;
      font-size: 18px;
      font-family: Arial, Verdana;
      padding: 5px;
      border-radius: 4px;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      -o-border-radius: 4px;
      background: #FFFFFF;
      background: linear-gradient(left, #FFFFFF, #F7F9FA);
      background: -moz-linear-gradient(left, #FFFFFF, #F7F9FA);
      background: -webkit-linear-gradient(left, #FFFFFF, #F7F9FA);
      background: -o-linear-gradient(left, #FFFFFF, #F7F9FA);
      color: #2E3133;
      width: 250px;
    }

    input[type=submit]
    {
      border: 1px solid #DBE1EB;
      font-size: 16px;
      font-family: Arial, Verdana;
      padding: 5px;
      border-radius: 4px;
      background-color: #0152CD;
      color:white;
      cursor: pointer;
      
    }
    
    input[type=text]:focus
    {
    color: #2E3133;
    border-color: #6AC0EF;
    }
    select 
    {
        padding:3px;
        margin: 0;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius:4px;
        -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
        -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
        box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
        background: #f8f8f8;
        color:#888;
        border:none;
        outline:none;
        display: inline-block;
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
        cursor:pointer;
        width: 200px;

    }

    /* Targetting Webkit browsers only. FF will show the dropdown arrow with so much padding. */
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        select {padding-right:18px}
    }

    .selection {position:relative}
    .selection:after {
        content:'<>';
        font:11px "Consolas", monospace;
        color:#aaa;
        -webkit-transform:rotate(90deg);
        -moz-transform:rotate(90deg);
        -ms-transform:rotate(90deg);
        transform:rotate(90deg);
        right:8px; top:2px;
        padding:0 0 2px;
        border-bottom:1px solid #ddd;
        position:absolute;
        pointer-events:none;
    }
    .selection:before {
        content:'';
        right:6px; top:0px;
        width:20px; height:20px;
        background:#f8f8f8;
        position:absolute;
        pointer-events:none;
        display:block;
    }

    #opciones
    {
      background: rgba(0,0,0,0.5);
      width: 12%;
      display: inline-block;
      height: 650px;
      
      
    }
    #opciones ul 
    {
      border-radius: 5px;
      color:rgba(255,255,255,0.5);
      list-style: none; 
      padding: 0;

    }
    #opciones ul li
    {
      padding: 0.5em 0;
    
    }
    #opciones ul li:hover
    {
      background: #3f9db8;
      color: white;
      cursor: pointer;
      padding-left: 5px; 
    }
    #info_usuario
    {
    	width: 87.5%;
      height: 600px;
    }
     #opciones, #info_usuario
    {
      display: inline-block;
      margin: 0;
      vertical-align: top;
    }
    #title
    {
      border: 1px solid white;
      background: white;
      width: 100%;
    }
    #title h3
    {
      margin: 5px;
    }
    .oculto
    {
    	display: none;
    }

.nice {
  font-family: arial;
  font-size: 12px;
  -webkit-box-shadow: 0px 1px 0px #fff, 0px -1px 0px rgba(0,0,0,.1);
  -moz-box-shadow: 0px 1px 0px #fff, 0px -1px 0px rgba(0,0,0,.1);
  box-shadow: 0px 1px 0px #fff, 0px -1px 0px rgba(0,0,0,.1); 
  -moz-border-radius: 4px; 
  -webkit-border-radius: 4px;
  border-radius: 4px;
}
.nice .NFI-button {
  -moz-border-radius-topleft: 3px; 
  -moz-border-radius-bottomleft: 3px;
  -webkit-border-top-left-radius: 3px;
  -webkit-border-bottom-left-radius: 3px;
  border-top-left-radius: 3px; 
  border-bottom-left-radius: 3px;

  background-color: #0192DD;

  background-image: linear-gradient(bottom, #1774A3 0%, #0194DD 56%);
  background-image: -o-linear-gradient(bottom, #1774A3 0%, #0194DD 56%);
  background-image: -moz-linear-gradient(bottom, #1774A3 0%, #0194DD 56%);
  background-image: -webkit-linear-gradient(bottom, #1774A3 0%, #0194DD 56%);
  background-image: -ms-linear-gradient(bottom, #1774A3 0%, #0194DD 56%);
  background-image: -webkit-gradient(
    linear,
    left bottom,
    left top,
    color-stop(0, #1774A3),
    color-stop(0.56, #0194DD)
  );
  text-shadow: 0px -1px 0px #0172bd;
  border: solid #0172bd 1px;
  border-bottom: solid #00428d 1px;
  
  -webkit-box-shadow: inset 0px 1px 0px rgba(255,255,255,.2);
  -moz-box-shadow: inset 0px 1px 0px rgba(255,255,255,.2);
  box-shadow: inset 0px 1px 0px rgba(255,255,255,.2);   
  
  color: #fff;
  width: 100px;
  height: 30px;
  line-height: 30px;
}
.nice .NFI-filename {
  -moz-border-radius-topright: 3px; 
  -moz-border-radius-bottomright: 3px;
  -webkit-border-top-right-radius: 3px;
  -webkit-border-bottom-right-radius: 3px;
  border-top-right-radius: 3px; 
  border-bottom-right-radius: 3px;

  width: 200px;
  border: solid #777 1px;
  border-left: none;
  height: 30px;
  line-height: 30px;
  
  background: #fff;
  -webkit-box-shadow: inset 0px 2px 0px rgba(0,0,0,.05);
  -moz-box-shadow: inset 0px 2px 0px rgba(0,0,0,.05);
  box-shadow: inset 0px 2px 0px rgba(0,0,0,.05); 

  color: #777;
  text-shadow: 0px 1px 0px #fff;
}

	</style>
  <script src="js/jquery.js"></script>
  <script src="js/nicefileinput.js"></script>
    <script type="text/javascript">

    $(document).on("ready", listo);

    function listo ()
    {
      $("#txtNumeroT").on("keypress", esNumero);
      $("input[type=file]").nicefileinput();
    }

    function esNumero(event)
    {
      
      if(isNaN(event.key) && event.charCode != 0)
      {
        event.preventDefault();
      }
    }
     function mostrar_ocultos(id)
      {
        var perfil = document.getElementById("informacion_perfil");
        var pass = document.getElementById("dv_contrasena");
        var editarP = document.getElementById("editar_perfil");
        var bt = document.getElementById("sbGuardar");

        var items = $("#opciones li");
        $.each(items, function(index, val) {
           /* iterate through array or object */
           alert
           if($(val).attr('value') != id)
           {
              $(val).css('color','rgba(255,255,255,0.5)');
           }
           else
           {
              $(val).css('color','white');
              $("h3").html($(val).attr("name"));
           }
        });

        if(id == "editar_perfil"){
          perfil.style.display = 'none'
          editarP.style.display = 'block';
          pass.style.display = 'none';
          bt.style.display = 'block';

        }
        else if( id== "dv_contrasena"){

            perfil.style.display = 'none';
          editarP.style.display = 'none';
          pass.style.display = 'block';
        }
        else if(id == "informacion_perfil"){
            
            perfil.style.display = 'block'
          editarP.style.display = 'none';
          pass.style.display = 'none';
        }
   }
  </script>
</head>
<body>
  <header><a href="index.php"><img src="img/home1.png"></a></header>
<div id="opciones">
	<ul>
	    <li name="Informacion de perfil" value="informacion_perfil" style="color:white" onclick="javascript:mostrar_ocultos('informacion_perfil');">Ver Perfil</a></li>
    	<li name="Editar perfil" value="editar_perfil" onclick="javascript:mostrar_ocultos('editar_perfil');">Editar Perfil</a></li>
      <li name="Cambiar Contraseña" value="dv_contrasena" onclick="javascript:mostrar_ocultos('dv_contrasena');">Cambiar Contrasena</a></li>
    
</div>
<div id="info_usuario">
  <div id="title"><h3>Informacion de perfil</h3></div>
	<div id="informacion_perfil">
		<table cellpadding="10" cellspacing="10">
		  <?php while($usuario = mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td>Nombre:</td>
				<td><?php echo $usuario["nombre_usuario"];?></td>
			</tr>
			<tr>
				<td>Fecha de Nacimiento:</td>
				<td><?php echo $usuario["fecha_nacimiento"];?></td>
			</tr>
			<tr>
				<td>Numero Telefonico:</td>
				<td><?php echo $usuario["numero_telefonico"];?></td>
			</tr>
			<tr>
				<td>Correo Electronico:</td>
				<td><?php echo $usuario["correo_electronico"];?></td>
			</tr>
			<tr>
				<td>Pais:</td>
				<td><?php echo $usuario["nombre_pais"];?></td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td><?php echo $usuario["nombre_ciudad"];?></td>
			</tr>		
		</table>
  	</div>
 
   <div id="editar_perfil" class="oculto">
   <form id="frmActualizar" action=" " method="Post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="10">
			<tr>
				<td>Nombre:</td>
				<td><input type="Text" id="txtNombre" name="txtNombre" value="<?php echo $usuario["nombre_usuario"];?>"/></td>
			</tr>
			<tr>
				<td>Fecha de Nacimiento:</td>
				<td><input type="date" id="txtFecha" name="txtFecha" value="<?php echo $usuario["fecha_nacimiento"];?>"/></td>
			</tr>
			<tr>
				<td>Foto:</td>
				<td><input type="file" id="txtFoto" class="nice" name="txtFoto"/></td>
			</tr>
			<tr>
				<td>Numero Telefonico:</td>
				<td><input type="Text" id="txtNumeroT" name="txtNumeroT"  value="<?php echo $usuario["numero_telefonico"];?>"/></td>
			</tr>
			<tr>
				<td>Correo Electronico:</td>
				<td><input type="Text" id="txtCorreo" name="txtCorreo" value="<?php echo $usuario["correo_electronico"];?>"/></td>
			</tr>
			<tr>
			<tr>
				<td>Sexo:</td>
				<td><label><input name="sex" type="radio" value="Masculino" <?php if($usuario["sexo"] == "Masculino"){echo 'checked="checked"';}?>/>Masculino</label><label><input name="sex" type="radio" value="Femenino"  <?php if($usuario["sexo"] == "Femenino"){ echo 'checked="checked"';}?> />Femenino</label></td>
			</tr>
				<td>Pais:</td>
				<td>
					<label class="selection"><select id="Slpais" name="Slpais" onclick="filtrar();">
					<?php while ($pais = mysqli_fetch_assoc($result2)){?>
					<option <?php if ($usuario["id_pais"] == $pais["id"]) { echo 'selected="selected"'; }?> value="<?php echo $pais["id"];?>" ><?php echo $pais["nombre_pais"];?></option>
					<?php }?>
					</select></label>
				</td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td>
					<div id="selCiudad">
					<label class="selection"><select id="Slciudad" name="Slciudad" >
					<?php while ($ciudad = mysqli_fetch_assoc($result3)){ ?>
					<option value="<?php echo $ciudad["id"];?>" <?php if ($usuario["id_ciudad"] == $ciudad["id"]) { echo 'selected="selected"'; }?> ><?php echo $ciudad["nombre_ciudad"];?></option>
					<?php }?>
			    	</select></label>
			    	</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" id="sbGuardarPerfil" name="sbGuardarPerfil" value="Guardar" /></td>
			</tr>
		<?php }?>
	</table>
   </form>
  </div>

 <div id="dv_contrasena" class="oculto">
  <form id="frmContrasena" action="" method="Post">
  	<table cellspacing="10" cellpadding="7">
  		<tr>
  			<td>Contrasena Anterior:</td>
  			<td><input type="password" id="txtPass_anterior" name="txtPass_anterior" onmouseout="Comprobar_Contrasena();"></td>
  			<td><div id="msj_Wpass"></div></td>
  		</tr>
  		<tr colspan="3">
  			<td>Contrasena Nueva:</td>
  			<td><input type="password" id="txtPass_nueva" name="txtPass_nueva"></td>
  		</tr>
  		<tr >
  			<td>Confirme Contrasena:</td>
  			<td><input type="password" id="txtConfirmar_pass" name="txtConfirmar_pass" onmouseout="Nueva_Contrasena();"></td>
  			<td><div id="msj_WNpass"></div></td>
  		</tr>
  		<tr >
        <td></td>
  			<td><input type="submit" id="sbGuardarPass" name="sbGuardarPass" value="Guardar" /></td>
  		</tr>
  	</table>
   </form>
   <input type="hidden" id="txtId" name= "txtId" value= "1" /> <!-- value="<?php //echo $_SESSION["id"]?>" CAMBIARRR!!!! -->
  </div>
</div>

<script type="text/javascript">

	var xmlAjax;
	  if(window.XMLHttpRequest) 
      {
        xmlAjax = new XMLHttpRequest();
      } 
      else 
      {
        xmlAjax = new ActiveXObject("Microsoft.XMLHTTP");
      }

	function filtrar() 
    { 
        xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {//satisfactorio

            var sel = document.getElementById("selCiudad");

            if(xmlAjax.responseText != "")
            {
              sel.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('selCiudad').style.display = 'none';       
            }
            
          }
          else 
          {//error
            alert("error");
          }
        }
      }
        var consulta = document.getElementById("Slpais").value;

        xmlAjax.open("GET","filtro_ciudades.php?consulta=" + consulta, true);
        xmlAjax.send();
    } 

    function Comprobar_Contrasena()
    { 
       xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {

            var div = document.getElementById("msj_Wpass");

            if(xmlAjax.responseText != "")
            {
               div.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('msj_Wpass').style.display = 'none';       
            }
            
          }
          else 
          {
            alert("error");
          }
        }
      }
        var pass = document.getElementById("txtPass_anterior").value;
        var id = document.getElementById("txtId").value; 
        xmlAjax.open("GET","ComprobarPass.php?id="+ id + "&pass=" + pass, true);
        xmlAjax.send();
    }

 function Nueva_Contrasena()
    {
       xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {

            var div = document.getElementById("msj_WNpass");

            if(xmlAjax.responseText != "")
            {
               div.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('msj_WNpass').style.display = 'none';       
            }
            
          }
          else 
          {
            alert("error");
          }
        }
      }
        var texto1 = document.getElementById("txtPass_nueva").value;
        var texto2 = document.getElementById("txtConfirmar_pass").value;
        xmlAjax.open("GET","nueva_pass.php?texto1="+ texto1 + "&texto2=" + texto2, true);
        xmlAjax.send();
    }

</script>
<footer>&nbsp</footer>
</body>
</html>