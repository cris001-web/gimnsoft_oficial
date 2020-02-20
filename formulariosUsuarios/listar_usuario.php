<?php include("../config/class.conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>listar clientes</title>
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
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
				<th>Foto</th>
			</tr>

			<!-- consulta para llenar tabla -->
			<?php
				$query_usuario = mysqli_query($conexion,"SELECT usuarios.nombre_usuario,usuarios.email, usuarios.activo, usuarios.rol_id,roles.rol_descripcion, clientes.nombre,clientes.apellido,clientes.foto FROM usuarios INNER JOIN roles on usuarios.rol_id=roles.id INNER JOIN clientes ON usuarios.id=clientes.usuario_id");
				

				//devuelve cantidad de filas
				$filas_usuarios= mysqli_num_rows($query_usuario);
		

				if ($filas_usuarios>0 ) {
					while ($data_usuario = mysqli_fetch_array($query_usuario)) {
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
						<td><img src="../uploads/<?php echo $ruta_img; ?>" width="100"/></td>
						<td>
							<a href="../formulariosRoles/actualizar_rol.php?id=<?php echo $data['id']; ?>"><button type="button" class="btn btn-primary">Editar</button></a>
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
