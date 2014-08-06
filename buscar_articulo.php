<?php 
	require_once("conexion.php");

	if(isset($_GET["nombre"]))
	{
		$nombre = $_GET["nombre"];
		$result = mysqli_query($conexion, "SELECT  * FROM articulo WHERE nombre_articulo LIKE '$nombre%' LIMIT 10");
		if(mysqli_num_rows($result) > 0)
		{
?>
		<ul>
			<?php while ($row = mysqli_fetch_assoc($result)) { ?>
			<li style="list-style: none;" onClick='seleccionarArticulo(this)' value='<?php echo $row["nombre_articulo"]; ?>'><?php echo $row["nombre_articulo"]; ?></li>
			<?php } mysqli_free_result($result); ?>
			
		</ul>
<?php
		}
	}
?>