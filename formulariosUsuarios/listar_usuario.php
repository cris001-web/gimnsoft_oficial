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
				$query_usuario = mysqli_query($conexion,"SELECT (usuarios.id) as id_u, usuarios.nombre_usuario,usuarios.email, usuarios.activo, usuarios.rol_id,roles.rol_descripcion,(clientes.id) as id_c, clientes.nombre,clientes.apellido,clientes.foto FROM usuarios INNER JOIN roles on usuarios.rol_id=roles.id INNER JOIN clientes ON usuarios.id=clientes.usuario_id");
				
				echo "SELECT (usuarios.id) as id_u, usuarios.nombre_usuario,usuarios.email, usuarios.activo, usuarios.rol_id,roles.rol_descripcion,(clientes.id) as id_c, clientes.nombre,clientes.apellido,clientes.foto FROM usuarios INNER JOIN roles on usuarios.rol_id=roles.id INNER JOIN clientes ON usuarios.id=clientes.usuario_id";
				//devuelve cantidad de filas
				$filas_usuarios= mysqli_num_rows($query_usuario);
		

				if ($filas_usuarios>0 ) {
					while ($data_usuario = mysqli_fetch_array($query_usuario)) {
						$id_usuario= $data_usuario['id_u'];
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
							<a href="../formulariosUsuarios/actualizar_usuarios.php?id_usuario_get=<?php echo $data_usuario['id_u']; ?>"><button type="button" class="btn btn-primary">Editar</button></a>

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
