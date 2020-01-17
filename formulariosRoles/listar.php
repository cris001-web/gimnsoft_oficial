<?php include("../config/class.conexion.php");?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<table class="table table-dark">
			<thead>
				<tr>
					<th >#</th>
					<th >Nombre del Rol</th>

				</tr>
				<?php
					$query = mysqli_query($conexion, "SELECT * FROM roles"); 
					//devuelve cantidad de filas
					$filas= mysqli_num_rows($query);
					
				
				if ($filas>0) {
					while ($data = mysqli_fetch_array($query)){
						//$id=$data['id'];
				?>		
						<tr>
						      
						      <td><?php echo $data['id'] ?></td>
						      <td><?php echo $data['rol_descripcion'] ?></td>
						     
								<td>
									<a href="../formulariosRoles/actualizar_rol.php?id=<?php echo $data['id']; ?>"><button type="button" class="btn btn-primary">Editar</button></a>
								
									<a href="../formulariosRoles/eliminar_rol.php?id=<?php echo $data['id']; ?>"><button type="button" class=" button btn btn-primary">Eliminar</button></a>
									
									<input type="hidden" id="php_id" value="<?php echo $id; ?>"/>

									<?php echo $id; ?>

								</td>
						</tr>
				<?php
						
					}
				}
				?>
	
			</thead>
		</table>
	</div>
<p>Content here. <a class="show-alert" href=#>Alert!</a></p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<!-- bootbox code -->
<script src="../bootbox/bootbox.min.js"></script>
<script src="../bootbox/bootbox.locales.min.js"></script>


	<!-- jquery bootstrap-->
<script src="../bootstrap4/js/bootstrap.min.js"></script>
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>
</body>
</html>

