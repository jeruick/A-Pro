<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <title>Registro de usuario</title>
</head>
<body>
	<h1>Cree su cuenta A+PRO</h1>
	<form action="" method="post">
		<table cellspacing="4" cellpadding="0">
			<tr>
				<td><label>Nombre usuario:</label></td>
			</tr>
			<tr>
				<td><input type="text" name="nombreUsuario" style="width:200px"/></td>
			</tr>
			<tr>
				<td><label>Apellidos usuario:</label></td>
			</tr>
			<tr>
				<td><input type="text" name="apellidosUsuario" style="width:200px"/></td>
			</tr>
			<tr>
				<td><label>Fecha de nacimiento:</label></td>
			</tr>
			<tr>
				<td><input type="date" name="fechaNacimiento" style="width:200px"></td>
			</tr>
			<tr>
				<td><label>Sexo:</label></td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="sexo" value="Masculino"/><label for="sexo">Masculino</label>
					<input type="radio" name="sexo" value="Femenino"/><label for="sexo">Femenino</label>
				</td>
			</tr>
			<tr>
			<td><label>Pais:</label></td>
			</tr>
			<tr>
				<td>
					<select name="pais" style="width:200px">
						<option value=""></option>
					</select>
				</td>
			</tr>
			<tr>
			<td><label>Ciudad:</label></td>
			</tr>
			<tr>
				<td>
					<select name="ciudad" style="width:200px">
						<option value=""></option>
					</select>
				</td>
			</tr>
			<tr>
			<td><label>Teléfono:</label></td>
			</tr>
			<tr>
				<td><input type="tel" name="numeroTelefono" style="width:200px"/></td>
			</tr>
			<tr>
			<td><label>Correo electrónico:</label></td>
			</tr>
			<tr>
				<td><input type="email" name="correoElectronico" style="width:200px"/></td>
			</tr>
			<tr>
			<td><label>Contraseña:</label></td>
			</tr>
			<tr>
				<td><input type="password" name="contraseña" style="width:200px"/></td>
			</tr>
			<tr>
			<td><label>Confirmar contraseña:</label></td>
			</tr>
			<tr>
				<td><input type="password" name="confirmarContraseña" style="width:200px"/></td>
			</tr>
			<tr>
				<td><input type="submit" value="Crear usuario"></td>
			</tr>
		</table>
	</form>
</body>
</html>