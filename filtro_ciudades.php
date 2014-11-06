<?php
require_once("conexion.php");
$consulta = -1;
if(isset($_GET["consulta"])){
	$consulta = $_GET["consulta"];
}

$query = "SELECT * FROM ciudad WHERE id_pais = $consulta";
$result = mysqli_query($conexion, $query);

?>
<div id="selCiudad">
<select name="Slciudad" style="width:125px;">
    <?php while($ciudad = mysqli_fetch_assoc($result)){?>
	<option value="<?php echo $ciudad["id"];?>"><?php echo $ciudad["nombre_ciudad"];?></option>
	<?php } mysqli_free_result($result);?>
</select>
</div>

