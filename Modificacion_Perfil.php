<?php
require_once("clases/Usuario.php");
require_once("clases/Conexion.php");
session_start();
if(isset($_SESSION["usuario_valido"]))
{

	$id = $_SESSION["usuario_valido"];  
	$usuario = new Usuario(); 
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
	    	$foto = $_FILES["txtFoto"];
			$usuario->ActualizarInformacion($id, $nombre, $nacimiento, $genero, $numero_t, $correo, $foto,$ciudad);	
	    }
	    else
	    {
	    	$usuario->ActualizarInformacion($id, $nombre, $nacimiento, $genero, $numero_t, $correo,null,$ciudad);		
	    }
}

// ACTUALIZACION DE CONTRASENA
       if(isset($_POST["txtPass_nueva"]) && isset($_POST["txtConfirmar_pass"]) && isset($_POST["txtPass_anterior"]))
      {  
      	$old_pass = $_POST["txtPass_anterior"];
      	$new_pass = $_POST["txtPass_nueva"];
      	if ($old_pass === $new_pass) 
      	{
      		$usuario->ActualizarPassword($id, $new_pass);
      	}
      }

      $result = $usuario->ObtenerInformacionUsuario($id);
}
else
{

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
	<title>Perfil de usuario</title>
  		<meta charset="utf-8" />
	  	<link rel="stylesheet" href="css/globals.css">

		<link rel="stylesheet" type="text/css" href="css/perfil.css">
		
	  <script src="js/jquery.js"></script>
	  <script src="js/nicefileinput.js"></script>
	  <script src="js/perfil.js"></script>
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
  <div id="title" class="informacion_perfil" ><center><h2>Informacion de perfil</h2></center></div>
	<div id="informacion_perfil" class="table-responsive">
		<table cellpadding="10" cellspacing="10" class="table ">
		  <?php while($usuario = mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td id="foto_usuario" colspan="1"><img style="width:200px;" src="<?php echo 'foto_perfil/'.$usuario["foto_usuario"]; ?>" /></td>
			</tr>
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
 
   <div id="editar_perfil" class="oculto" class="table-responsive">
   <form id="frmActualizar" action=" " method="Post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="10" class="responsive">
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
  			<td><input type="password" id="txtPass_anterior" name="txtPass_anterior" onBlur="Comprobar_Contrasena();"></td>
  			<td><div id="msj_Wpass"></div></td>
  		</tr>
  		<tr colspan="3">
  			<td>Contrasena Nueva:</td>
  			<td><input type="password" id="txtPass_nueva" name="txtPass_nueva"></td>
  		</tr>
  		<tr >
  			<td>Confirme Contrasena:</td>
  			<td><input type="password" id="txtConfirmar_pass" name="txtConfirmar_pass" onBlur="Nueva_Contrasena();"></td>
  			<td><div id="msj_WNpass"></div></td>
  		</tr>
  		<tr >
        <td></td>
  			<td><input type="submit" id="sbGuardarPass" name="sbGuardarPass" value="Guardar" /></td>
  		</tr>
  	</table>
   </form>
   <input type="hidden" id="txtId" name= "txtId" value= "<?php echo $id ?>" /> 
  </div>
</div>

<footer>&nbsp</footer>
<script>
	
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
        var pass = document.getElementById("txtPass_anterior").value;
        var id = document.getElementById("txtId").value; 
        $.ajax({
          url: 'clases/comprobar_pass.php',
          type: 'GET',
          data: {id: id, pass: pass},
        })
        .done(function(response) {
        	if (response != "") 
        	{
        		$("#msj_Wpass").html(response);
        	}
        	else
        	{
        		$("#msj_Wpass").html("");
        	}
          
        });
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
	        xmlAjax.open("GET","clases/nueva_pass.php?texto1="+ texto1 + "&texto2=" + texto2, true);
	        xmlAjax.send();
	    }

</script>
</body>
</html>