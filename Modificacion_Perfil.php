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
       if(isset($_POST["txtPass_nueva"]) && isset($_POST["txtConfirmar_pass"]) && isset($_POST["txtPass_anterior"]))
      {  
        $con_pass = "SELECT contrasena FROM usuario WHERE id= $id";
        $fila = mysqli_query($conexion, $con_pass);
        $Oldpass = md5($_POST["txtPass_anterior"]); 
        $filas = mysqli_fetch_assoc($fila);

        if($filas["contrasena"] == $Oldpass)
        {
             if($_POST["txtPass_nueva"] == $_POST["txtConfirmar_pass"])
              {
                $pass = md5($_POST["txtConfirmar_pass"]);

              $consultaPass = "UPDATE usuario SET contrasena = '$pass' WHERE id= $id"; 
              mysqli_query($conexion, $consultaPass);
              }
              else{ echo "error1"; }
         }
         else{ echo "error"; }
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
	<div id="informacion_perfil">
		<table cellpadding="10" cellspacing="10">
		  <?php while($usuario = mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td colspan="1"><img style="width:200px;" src="<?php echo 'foto_perfil/'.$usuario["foto_usuario"]; ?>" /></td>
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
          url: 'ComprobarPass.php',
          type: 'GET',
          data: {id: id, pass: pass},
        })
        .done(function(response) {
          $("#msj_Wpass").html(response);
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
	        xmlAjax.open("GET","nueva_pass.php?texto1="+ texto1 + "&texto2=" + texto2, true);
	        xmlAjax.send();
	    }

</script>
</body>
</html>