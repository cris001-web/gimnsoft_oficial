<?php include("../config/class.conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>listar clientes</title>
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">

	<!-- MENU -->
	<link rel="stylesheet" type="text/css" href="../style/style_menu.css">
	<link rel="stylesheet" type="text/css" href="../style/css/font-awesome.css">

	<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>
	<script src="../javascript/main_menu.js"></script>
</head>
<?php include("../menu.html"); ?>

<body>
<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Nombre Usuario</th>
				<th>Correo</th>
				<th>Estado del Usuario</th>
				<th>Tipo de Rol</th>
				<th>Nombre del Cliente</th>
				<th>Apellido del Cliente</th>
				<th>Objetivo</th>
				<th>Localidad</th>
				<th>Sexo</th>
				<th>Foto</th>
			</tr>

			<!-- consulta para llenar tabla -->
			<?php
				$query_usuarios = mysqli_query($conexion,"SELECT usuarios.id_usuario, usuarios.nombre_usuario,usuarios.email, usuarios.activo, usuarios.rol_id,roles.rol_descripcion, alumnos.id_alumno, alumnos.nombre,alumnos.apellido,alumnos.objetivo,alumnos.localidad_id,localidades.descripcion_l,alumnos.sexo_id,generos.descripcion_s,alumnos.foto FROM usuarios INNER JOIN roles on usuarios.rol_id=roles.id INNER JOIN alumnos ON usuarios.id_usuario=alumnos.usuario_id INNER JOIN localidades on alumnos.localidad_id=localidades.id_localidad INNER JOIN generos on alumnos.sexo_id=generos.id_sexo");
				
				echo "SELECT usuarios.id_usuario, usuarios.nombre_usuario,usuarios.email, usuarios.activo, usuarios.rol_id,roles.rol_descripcion, alumnos.id_alumno, alumnos.nombre,alumnos.apellido,alumnos.objetivo,alumnos.localidad_id,localidades.descripcion_l,alumnos.sexo_id,generos.descripcion_s,alumnos.foto FROM usuarios INNER JOIN roles on usuarios.rol_id=roles.id INNER JOIN alumnos ON usuarios.id_usuario=alumnos.usuario_id INNER JOIN localidades on alumnos.localidad_id=localidades.id_localidad INNER JOIN generos on alumnos.sexo_id=generos.id_sexo";
				//devuelve cantidad de filas
				$filas_usuarios= mysqli_num_rows($query_usuarios);
		

				if ($filas_usuarios>0 ) {
					while ($data_usuario = mysqli_fetch_array($query_usuarios)) {
						$id_usuario= $data_usuario['id_usuario'];
						$ruta_img=$data_usuario['foto'];

						
					?>
					<tr>
						<td><?php echo $data_usuario['nombre_usuario'] ?></td>
						<td><?php echo $data_usuario['email'] ?></td>
						<td><?php
						if ($data_usuario['activo']==1) {
							echo "ACTIVO";
						}else{
							echo "INACTIVO";
						}

						?>
							
						</td>
						<td><?php echo $data_usuario['rol_descripcion']?></td>
						<td><?php echo $data_usuario['nombre']?></td>
						<td><?php echo $data_usuario['apellido']?></td>
						<td><?php echo $data_usuario['objetivo']?></td>
						<td><?php echo $data_usuario['descripcion_l']?></td>
						<td><?php echo $data_usuario['descripcion_s']?></td>
						<td><img src="../uploads/<?php echo $ruta_img; ?>" width="100"/></td>
						<td>
							<a href="../formulariosUsuarios/actualizar_usuarios.php?id_usuario_get=<?php echo $data_usuario['id_usuario']; ?>"><button type="button" class="btn btn-primary">Editar</button></a>

							<a href="../formulariosUsuarios/eliminar_usuarios.php?id_usuario_get=<?php echo $data_usuario['id_usuario']; ?>"><button type="button" class=" button btn btn-primary">Eliminar</button></a>

							<input type="hidden" id="php_id" value="<?php echo $id_u; ?>"/>
						</td>
						

					</tr>
					<?php
					}				
				}
			?>
		</thead>
	</table>
</div>
</body>
</html>
