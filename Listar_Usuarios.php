<?php
  	require_once("conexion.php");
  	session_start();
	if(isset($_SESSION["usuario_valido"]))
	{
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			mysqli_query($conexion, "DELETE FROM usuario WHERE id = $id");
		}
		$id = $_SESSION["usuario_valido"];

		$query = "SELECT u.id AS id_usuario, nombre_usuario, fecha_nacimiento, sexo, numero_telefonico, correo_electronico,
				  foto_usuario, admin, c.id, c.nombre_ciudad, p.id, p.nombre_pais 
				  FROM usuario u, ciudad c, pais p WHERE u.id_ciudad = c.id AND c.id_pais = p.id";
		$result = mysqli_query($conexion, $query);

	}
	else
	{
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Administracion de usuarios</title>
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
	    a
	    {
	    	background: #ed6464;
	    	border-radius: 20%;
	    	color: white;
	    	margin-left: 0.5em;
	    	margin-bottom: 2em;
			padding: 0.5em;
			text-decoration: none;
	    }
	    #delete
	    {
	    	background: #b20000;
	    }
	    #update
	    {
	    	background: #637c96;
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
		th, td
		{
			border: 2px solid white;
			box-shadow: rgba(0,0,0,0.2) 0px 0px 10px;
			margin: 0px;
		}
		table
		{
			margin: 0 auto;
		}
		.block
		{
			display: inline-block;
			vertical-align: middle;

		}
		.block p 
		{
			background: white;
			display: none;
			box-shadow: rgba(0,0,0,0.5) 0px 0px 10px;
			font-size: 12px;
			padding: 10px;
			margin: 0;
			position: absolute;
		}
		.block img:hover
		{
			cursor: pointer;
		}

		.textbox { 
		    background: white; 
		    border: 1px solid #DDD; 
		    border-radius: 5px; 
		    box-shadow: 0 0 5px #DDD inset; 
		    color: #666; 
		    outline: none; 
		    height:25px; 
		    width: 400px; 
		   }


	</style>
	<script src="js/jquery.js"></script>
	<script>
		$(document).on("ready", listo);

		function listo()
		{

			$(".block img").on("click", nuevoUsuario);
			$(".block img").on("mouseover", mostrar);
			$(".block img").on("mouseout", ocultar);

		}
		function mostrar()
		{
			$(".block p").show('fast');
		}
		function ocultar()
		{
			$(".block p").hide('fast');
		}
		function nuevoUsuario()
		{
			$(location).attr('href','registro_usuario2.php');
		}
	</script>

</head>
<body>
	<header><h1>Administracion de Usuarios</h1></header>
	<div class="block" style="width:89%; " id="home"><a href="index.php">Home</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<label>Buscar:</label>&nbsp&nbsp<input type="Text" id="txtBuscar" name="txtBuscar" onkeyup="Buscar();" class="textbox"></div>
	<div class="block" style="width:8%; "><img src="img/user.png"><p>Nuevo Usuario</p></div>
	<table cellpadding="10" cellspacing="0" id="tblBusqueda">
		<tr>
			<th>Foto</th>
			<th>Nombre</th>
			<th>Fecha Nacimiento</th>
			<th>Numero Telefono</th>
			<th>Correo Electronico</th>
			<th>Sexo</th>
			<th>Ciudad</th>
			<th>Pais</th>
			<th>Tipo de Usuario</th>
			<th colspan= "2">Acciones</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>		
			<tr>
				<td><img src="<?php echo "foto_perfil/".$row['foto_usuario']; ?>" style="width:100px; height:100px" /></td>
				<td><p><?php echo $row["nombre_usuario"]; ?></p></td>
				<td><p><?php echo $row["fecha_nacimiento"]; ?></p></td>
				<td><p><?php echo $row["numero_telefonico"]; ?></p></td>
				<td><p><?php echo $row["correo_electronico"]; ?></p></td>
				<td><p><?php echo $row["sexo"]; ?></p></td>
				<td><p><?php echo $row["nombre_ciudad"]; ?></p></td>
				<td><p><?php echo $row["nombre_pais"]; ?></p></td>
				<td><p><?php if($row["admin"] == 1){ echo "Administrador";} else{ echo "Normal"; }?></p></td>
				<td><p><a id="update" href="modificar_usuario.php?id=<?php echo $row["id_usuario"];?>">Modificar</a></p></td>
				<td><p><a id="delete" href="listar_usuarios.php?id=<?php echo $row["id_usuario"];?>">Eliminar</a></p></td>
			</tr>					
		<?php  }?>	
	</table>

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

  function Buscar() 
    { 
        xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {//satisfactorio

            var tbl = document.getElementById("tblBusqueda");
            var div = document.getElementById("dv1");

            if(xmlAjax.responseText != "")
            {
              tbl.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('tblBusqueda').style.display = 'none'; 
            }
            
          }
          else 
          {//error
            alert("error");
          }
        }
      }
        var consulta = document.getElementById("txtBuscar").value;

        xmlAjax.open("GET","Filtrar_Usuario.php?consulta=" + consulta, true);
        xmlAjax.send();
    } 
</script>
</body>
</html>