<?php
require_once("conexion.php");

if(isset($_GET["consulta"])){

	$consulta = $_GET["consulta"];

	$query = "SELECT u.id AS id_usuario, nombre_usuario, fecha_nacimiento, sexo, numero_telefonico, correo_electronico,
			  foto_usuario, admin, c.id, c.nombre_ciudad, p.id, p.nombre_pais 
		      FROM usuario u, ciudad c, pais p WHERE u.id_ciudad = c.id AND c.id_pais = p.id AND u.nombre_usuario LIKE '%".$consulta."%'";
	$result = mysqli_query($conexion, $query); ?>	

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
		<?php while ($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><img src="<?php echo "foto_perfil/".$row['foto_usuario']; ?>" style="width:100px; height:100px" /></td>
			<td><p><?php echo $row["nombre_usuario"]; ?></p></td>
			<td><p><?php echo $row["fecha_nacimiento"]; ?></p></td>
			<td><p><?php echo $row["numero_telefonico"]; ?></p></td>
			<td><p><?php echo $row["correo_electronico"]; ?></p></td>
			<td><p><?php echo $row["sexo"]; ?></p></td>
			<td><p><?php echo $row["nombre_ciudad"]; ?></p></td>
			<td><p><?php echo $row["nombre_pais"]; ?></p></td>
			<td><p><?php if($row["admin"] == 1){ echo "Administrador"; }else{ echo "Normal"; }?></p></td>
			<td><p><a id="update" href="modificar_usuario.php?id=<?php echo $row["id_usuario"];?>">Modificar</a></p></td>
			<td><p><a id="delete" href="listar_usuarios.php?id=<?php echo $row["id_usuario"];?>">Eliminar</a></p></td>
		</tr>
</table>
<?php } } mysqli_free_result($result); ?>