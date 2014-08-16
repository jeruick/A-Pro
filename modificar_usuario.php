<?php
require_once("conexion.php");
session_start();
if(isset($_SESSION["usuario_valido"]))
{
 $id= $_GET["id"];

if(isset($_POST["txtNombre"]))
{

		$nombre = $_POST["txtNombre"];
		$fecha_nac = $_POST["txtFecha"];
		$correo = $_POST["txtCorreo"];
		$genero = $_POST["sex"];
		$numero_t = $_POST["txtNumeroT"];
		$ciudad = $_POST["Slciudad"];
		$prueba = strtotime($fecha_nac);
		$tipoUsuario = $_POST["tipoUser"];

		$nacimiento = date("Y-m-d", $prueba);
	
		// SI ACTUALIZA FOTO 
	    if($_FILES["txtFoto"]["name"] != "")
	    {
			$foto = $_FILES["txtFoto"]["name"];

			move_uploaded_file($_FILES["txtFoto"]["tmp_name"], "foto_perfil/". $_FILES["txtFoto"]["name"]);

			$query = "UPDATE usuario SET nombre_usuario = '$nombre', fecha_nacimiento = '$nacimiento', sexo='$genero', numero_telefonico = '$numero_t',
						correo_electronico ='$correo', foto_usuario ='$foto', id_ciudad = $ciudad, admin = $tipoUsuario WHERE id= $id";
		    mysqli_query($conexion, $query);		    	 
	    }
	    else if($_FILES["txtFoto"]["name"] == "")
	    {
	    	$query = "UPDATE usuario SET nombre_usuario = '$nombre', fecha_nacimiento = '$nacimiento', sexo='$genero', numero_telefonico = '$numero_t',
						correo_electronico='$correo', id_ciudad= $ciudad, admin = $tipoUsuario WHERE id= $id";

			mysqli_query($conexion, $query);
	    }
}

       $consulta = "SELECT nombre_usuario, fecha_nacimiento, sexo, numero_telefonico, foto_usuario, contrasena,
        correo_electronico, nombre_ciudad, nombre_pais, id_pais, id_ciudad, admin
        FROM usuario, ciudad, pais 
        WHERE usuario.id = $id AND usuario.id_ciudad = ciudad.id AND ciudad.id_pais = pais.id";

  $result = mysqli_query($conexion, $consulta);

$consulta2 = "SELECT * FROM pais";
$consulta3 = "SELECT * FROM ciudad";
$result2 = mysqli_query($conexion, $consulta2);
$result3= mysqli_query($conexion,$consulta3);

}
else
{ header("location: index.php"); }

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Actualizacion de usuario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8"> 
   	
    <link rel="stylesheet" href="css/simplePagination.css">
    <link rel="stylesheet" href="css/globals.css">
	<style type="text/css">

 	body
	    {
	    	background: rgb(255,250,250);
	    	margin: 0;
	    	padding: 0;
	    }
	    header
	    {
	    	background: url(img/back.png);
	    	background-size: 150px;
	    	margin: 0;
	    	padding: 1em;
	    }
		h1
		{
			color: white;
			text-shadow: rgba(0,0,0,0.7) 2px 2px 10px;
			text-align: center;
		}

		h3{
			color: gray;
			text-shadow: rgba(0,0,0,0.3) 2px 2px 10px;
			text-align: center;
		 }

		td
		{
			border: 2px solid white;
			box-shadow: rgba(0,0,0,0.2) 0px 0px 10px;
			margin: 0px;
		}
		table
		{
			margin: 0 auto;
		}

		.boton { 
		  border: 1px solid #dedede;
		  border-radius: 3px;
		  color: #555;
		  display: inline-block;
		  font: bold 12px/12px HelveticaNeue, Arial;
		  padding: 8px 11px;
		  text-decoration: none;
		  width:150px;
		}
 
		  .textbox { 
		    background: white; 
		    border: 1px solid #DDD; 
		    border-radius: 5px; 
		    box-shadow: 0 0 5px #DDD inset; 
		    color: #666; 
		    outline: none; 
		    height:25px; 
		    width: 275px; 
		   }

		 .Select {
				width: 220px;
				position: relative;
			}
			 
		 select {
				width: 100%;
				background: #F3F3F3;
				color: #585757;
				padding: 5px;
				font-size: 13px;
				line-height: 100%;
				border: 1px solid #C1C1C1;
				border-radius: 0;
				height: 30px;
				-webkit-appearance: none;
			}
			 
		 option {
				padding: 10px;
			}

		form table td p {
			padding:3px 0px 3px 3px;
		}
		form table td p a 
		{
			text-decoration:none;
			color:#930;
			font-size:12px;
		}
	</style>
</head>
<body>
<header></a><h1>Administracion de Usuarios</h1></</header>
<div id="editar_perfil" class="oculto">
  <center><div id="title"><h3>Actualizacion de perfil de Usuario</h3></div></center>
   <form id="frmActualizar" action=" " method="Post" enctype="multipart/form-data">
	 <table cellpadding="10" cellspacing="10" width="600px">
			<tr>
			    <td colspan="2"><p><a href="Listar_Usuarios.php">Volver</a></p></td>
			</tr>
	 		<?php while($usuario = mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td>Nombre:</td>
				<td><input type="Text" id="txtNombre" name="txtNombre" value="<?php echo $usuario["nombre_usuario"];?>" class="textbox"/></td>
			</tr>
			<tr>
				<td>Fecha de Nacimiento:</td>
				<td><input type="date" id="txtFecha" name="txtFecha" value="<?php echo $usuario["fecha_nacimiento"];?>" /></td>
			</tr>
			<tr>
				<td>Foto:</td>
				<td><input type="file" id="txtFoto" class="nice" name="txtFoto" class="boton"/></td>
			</tr>
			<tr>
				<td>Numero Telefonico:</td>
				<td><input type="Text" id="txtNumeroT" name="txtNumeroT"  value="<?php echo $usuario["numero_telefonico"];?>" class="textbox" /></td>
			</tr>
			<tr>
				<td>Correo Electronico:</td>
				<td><input type="Text" id="txtCorreo" name="txtCorreo" value="<?php echo $usuario["correo_electronico"];?>"class="textbox" /></td>
			</tr>
			<tr>
			<tr>
				<td>Sexo:</td>
				<td><label><input name="sex" type="radio" value="Masculino" <?php if($usuario["sexo"] == "Masculino"){echo 'checked="checked"';}?>/>Masculino</label>
				<label><input name="sex" type="radio" value="Femenino"  <?php if($usuario["sexo"] == "Femenino"){ echo 'checked="checked"';}?> />Femenino</label></td>
			</tr>
				<td>Pais:</td>
				<td>
					<label class="selection"><select id="Slpais" name="Slpais" onclick="filtrar();" class="Select">
					<?php while ($pais = mysqli_fetch_assoc($result2)){ ?>
					<option <?php if ($usuario["id_pais"] == $pais["id"]) { echo 'selected="selected"'; }?> value="<?php echo $pais["id"];?>" ><?php echo $pais["nombre_pais"];?></option>
					<?php }?>
					</select></label>
				</td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td>
					<div id="selCiudad">
					<label class="selection"><select id="Slciudad" name="Slciudad" class="Select">
					<?php while ($ciudad = mysqli_fetch_assoc($result3)){ ?>
					<option value="<?php echo $ciudad["id"];?>" <?php if ($usuario["id_ciudad"] == $ciudad["id"]) { echo 'selected="selected"'; }?> ><?php echo $ciudad["nombre_ciudad"];?></option>
					<?php }?>
			    	</select></label>
			    	</div>
				</td>
			</tr>
			<tr>
				<td>Tipo Usuario:</td>
				<td><label><input name="tipoUser" type="radio" value="1" <?php if($usuario["admin"] == 1){echo 'checked="checked"';}?>/>Administrador</label>
				<label><input name="tipoUser" type="radio" value="0"  <?php if($usuario["admin"] == 0){ echo 'checked="checked"';}?> />Usuario Normal</label></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" id="sbGuardarPerfil" name="sbGuardarPerfil" value="Guardar" class="boton" /></td>
			</tr>
		<?php }?>
	</table>
   </form>
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
</script>

</body>
<footer>&nbsp</footer>
</html>