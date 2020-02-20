<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Usuarios</title>
<!-- bootstrap -->
<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">	
<link rel="stylesheet" type="text/css" href="../style/estilo_foto.css">
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>

</head>
<body>
<div class="container center-block" style="margin-top: 90px;">
	<form action="insertar_usuarios.php" method="POST" style="box-shadow: 1px 2px 6px 0px black; height: 500px;width: 60%;
    margin: auto;" enctype="multipart/form-data">
		<h2 class="text-white text-center" style="background: #6f6f6f">Actualizar Usuarios-Cliente</h2>

		<div class="form-group mx-2 mt-3" >
			
			<input type="text" class="form-control " name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese Nombre Usuario">
			<input type="email" class="form-control " name="email" id="email" placeholder="Ingrese Correo Electronico valido">
			<input type="password" class="form-control " name="contraseña" id="contraseña" placeholder="Ingrese Contraseña">
			<label><input type="checkbox" class="form-check-input ml-1 m" name="activo" id="activo" placeholder="estado" value="1" style="position: relative;"> Estado de la persona</label><br>
			
			

			<?php 
			include("../config/class.conexion.php");
				$query_rol=mysqli_query($conexion,"SELECT * FROM roles");
				$filas_rol=mysqli_num_rows($query_rol);
			 ?>
			<label>Elegir</label>
				<select class="form-control" name="rol_id" id="rol_id" >
				  	<?php
				  		if ($filas_rol>0) {
				  			while ($roles= mysqli_fetch_array($query_rol)) {
				  				?>
				  					<option value="<?php echo $roles["id"] ?>" ><?php echo $roles["id"] ?></option>
				  				<?php	
				  			}
				  		}
				  	?>
				</select>
			
			
			<input type="text" class="form-control " name="nombre" id="nombre" placeholder="Ingrese Nombre del Cliente">
			<input type="text" class="form-control " name="apellido" id="apellido" placeholder="Ingrese apellido del Cliente">
			<input type="text" class="form-control " name="calle" id="calle" placeholder="Calle del cliente">
			<input type="text" class="form-control " name="barrio" id="barrio" placeholder="Barrio del Cliente">
			<input type="text" class="form-control " name="localidad" id="localidad" placeholder="Ingrese Ciudad del Cliente">
			<div id="imagePreview" style="text-align: center;">
				<img src="../imagen/users.png" >
			</div>
			<div class="photo" >
				<input type="file" name="imagen" id="imagen" width="100" />
			</div>
			
			<input type="submit"  value="Guardar" class="btn btn-primary btn-lg my-5 mx-2" onclick=" return validarCampoUsuarios();" >
		</div>
	</form>
	
</div>

<!-- bootstrap jquery -->
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="../javascript/foto.js"></script>

</body>
</html>