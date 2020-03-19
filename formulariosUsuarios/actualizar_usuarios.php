<?php 
include("../config/class.conexion.php");
if (!empty($_POST)) {
	$id_alumno=$_POST['id_alumno'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$objetivo=$_POST['objetivo'];
	$sexo_id=$_POST['sexo_id'];
	$descripcion_s=$_POST['descripcion_s'];
	$calle=$_POST['calle'];
	$barrio=$_POST['barrio'];
	$localidad_id=$_POST['localidad_id'];
	$descripcion_l=$_POST['descripcion_l'];
	$ruta_img=$_POST['foto'];

	$id_usuario=$_POST['id_usuario'];
	$email=$_POST['email'];
	$contraseña=$_POST['contraseña'];
	$activo=$_POST['activo'];
	$nombre_usuario=$_POST['nombre_usuario'];

	//codigo de foto
	$nombre_imagen=$_FILES['imagen']['name'];
	$tipo_imagen  =$_FILES['imagen'] ['type'];
 	$tamagno_imagen  =$_FILES['imagen'] ['size'];

 	$carpeta_destino=$_SERVER['DOCUMENT_ROOT']. '../gimnsoftware/uploads/';
 	move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);


		//verifico que el nombre de usuario y correo no esten en la bd
		$query_verifico=mysqli_query($conexion,"SELECT id_usuario, nombre_usuario,email FROM usuarios WHERE (nombre_usuario='$nombre_usuario' AND id_usuario !='$id_usuario') or (email='$email' AND id_usuario !='$id_usuario')");
		echo "SELECT id_usuario, nombre_usuario,email FROM usuarios WHERE (nombre_usuario='$nombre_usuario' AND id_usuario !='$id_usuario') or (email='$email' AND id_usuario !='$id_usuario')".'<br>';

		$result_filas_verifico=mysqli_num_rows($query_verifico);
		if ($result_filas_verifico==0) {//si es cero filas, no existe usuario con ese nombre o correo
			echo " puede actualizar no existe correo".'<BR>';

			//actualizo clientes

			$query_update_alumnos=mysqli_query($conexion,"UPDATE alumnos SET id_alumno='$id_alumno', nombre='$nombre',apellido='$apellido',objetivo='$objetivo',localidad_id='$localidad_id',sexo_id='$sexo_id',calle='$calle',barrio='$barrio',foto='$nombre_imagen' WHERE id_alumno='$id_alumno'");

			echo "UPDATE alumnos SET id_alumno='$id_alumno', nombre='$nombre',apellido='$apellido',objetivo='$objetivo',localidad_id='$localidad_id',sexo_id='$sexo_id',calle='$calle',barrio='$barrio',foto='$nombre_imagen' WHERE id_alumno='$id_alumno'".'<br>';

				//verifico que query cliebntes sea correcto y si es hago query usuarios
				if ($query_update_alumnos) {
					//echo "QUERY clientes CORRECTO".'<BR>';
					$query_update_usuarios=mysqli_query($conexion,"UPDATE usuarios SET id_usuario='$id_usuario',nombre_usuario='$nombre_usuario',email='$email',contraseña='$contraseña',activo='$activo' WHERE id_usuario='$id_usuario'");

						if ($query_update_usuarios) {
							echo "QUERY  usuarios CORRECTO".'<BR>';
						}else{
							echo "NO SE PUDO ACTUALIZAR usuarios".'<BR>';
						}	
				

				}else{
					echo "NO SE PUDO ACTUALIZAR alumnos " .'<BR>';
				}
		}else{
			echo "EXISTE CORREO";
		}
	

}






//VERIFICA SI ID VACIA Y CARGA DATOS A INPUTS
if (!empty($_REQUEST['id_usuario_get'])) {
	$id_usuario_get=$_REQUEST['id_usuario_get'];
	
	$query=mysqli_query($conexion,"SELECT usuarios.id_usuario, usuarios.email, usuarios.contraseña,usuarios.activo,usuarios.nombre_usuario,alumnos.id_alumno, alumnos.nombre,alumnos.apellido,alumnos.objetivo,alumnos.localidad_id,localidades.descripcion_l,generos.descripcion_s,alumnos.sexo_id,alumnos.calle,alumnos.barrio,alumnos.usuario_id,alumnos.foto FROM usuarios INNER JOIN alumnos on usuarios.id_usuario=alumnos.usuario_id INNER JOIN localidades on alumnos.localidad_id=localidades.id_localidad INNER JOIN generos on alumnos.sexo_id=generos.id_sexo WHERE usuarios.id_usuario='$id_usuario_get'");

	

	//guarda cada campo de la sql en variable
	 		while ($data_a_u=mysqli_fetch_array($query)) {

	 			$id_alumno=$data_a_u['id_alumno'];
	 			//echo('id_clientes'.$id_clientes.'<BR>');
	 			$nombre=$data_a_u['nombre'];
	 			$apellido=$data_a_u['apellido'];
	 			$objetivo=$data_a_u['$objetivo'];
	 			$localidad_id=$data_a_u['$localidad_id'];
	 			$descripcion_l=$data_a_u['$descripcion_l'];
	 			$sexo_id=$data_a_u['$sexo_id'];
	 			$descripcion_s=$data_a_u['$descripcion_s'];
	 			$calle=$data_a_u['calle'];
	 			$barrio=$data_a_u['barrio'];
				$localidad=$data_a_u['localidad'];
	 			$ruta_img=$data_a_u['foto'];

				$id_usuario=$data_a_u['id_usuario'];
				//echo('id_usuarios'.$id_usuarios);
	 			$email=$data_a_u['email'];
	 			$contraseña=$data_a_u['contraseña'];
	 			$activo=$data_a_u['activo'];
	 			$nombre_usuario=$data_a_u['nombre_usuario'];

	 		}

}else{
	echo('<p class="alert alert-success alert-warning fade show">ID VACIA</p>');
}
?>

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
	<form action="actualizar_usuarios.php" method="POST" style="box-shadow: 1px 2px 6px 0px black; height: 500px;width: 60%;
    margin: auto;" enctype="multipart/form-data">
		<h2 class="text-white text-center" style="background: #6f6f6f">Actualizar Usuarios-Alumno</h2>

		<div class="form-group mx-2 mt-3" >
			<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

			<input type="text" class="form-control " name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese Nombre Usuario" value="<?php echo $nombre_usuario; ?>">

			<input type="email" class="form-control " name="email" id="email" placeholder="Ingrese Correo Electronico valido" value="<?php echo $email; ?>">

			<input type="password" class="form-control " name="contraseña" id="contraseña" placeholder="Ingrese Contraseña" value="<?php echo $contraseña; ?>">

			<label><input type="checkbox" class="form-check-input ml-1 m" name="activo" id="activo" placeholder="estado" value="1" style="position: relative;"> Estado de la persona</label><br>

			<input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">

			<input type="text" class="form-control " name="nombre" id="nombre" placeholder="Ingrese Nombre del Cliente" value="<?php echo $nombre; ?>">

			<input type="text" class="form-control " name="apellido" id="apellido" placeholder="Ingrese apellido del Cliente" value="<?php echo $apellido; ?>">

			<input type="text" class="form-control " name="calle" id="calle" placeholder="Calle del cliente" value="<?php echo $calle; ?>">

			<input type="text" class="form-control " name="barrio" id="barrio" placeholder="Barrio del Cliente" value="<?php echo $barrio; ?>">

			<!-- select sexo -->
			<?php 
			include("../config/class.conexion.php");
				$query_generos=mysqli_query($conexion,"SELECT * FROM generos");
				$filas_generos=mysqli_num_rows($query_generos);
			 ?>
			<label>Elegir Genero</label>
				<select class="form-control" name="sexo_id" id="sexo_id" value="<?php echo $descripcion_s; ?>">
					<?php
				  		if ($filas_generos>0) {

				  			while ($generos= mysqli_fetch_array($query_generos)) {

				  				?>


				  					<option value="<?php echo $generos["id_sexo"] ?>" ><?php echo $generos["descripcion_s"] ?></option>
				  				<?php	
				  			}
				  		}
				  	?>
				</select>

			<!-- select localidad -->
			<?php 
			include("../config/class.conexion.php");
				$query_localidades=mysqli_query($conexion,"SELECT * FROM localidades");
				$filas_localidades=mysqli_num_rows($query_localidades);
			 ?>
			<label>Elegir localidad</label>
				<select class="form-control" name="localidad_id" id="localidad_id" value="<?php echo $descripcion_l; ?>">
					<?php
				  		if ($filas_localidades>0) {

				  			while ($localidades= mysqli_fetch_array($query_localidades)) {

				  				?>


				  					<option value="<?php echo $localidades["id_localidad"] ?>" ><?php echo $localidades["descripcion_l"] ?></option>
				  				<?php	
				  			}
				  		}
				  	?>
				</select>

			<div id="imagePreview" style="text-align: center;">
				<img src="../uploads/<?php echo $ruta_img; ?>" width="100"/>
			</div>
			<div class="photo" >
				<input type="file" name="imagen" id="imagen" width="100" />
			</div>
			
			<input type="submit"  value="Actualizar" class="btn btn-primary btn-lg my-5 mx-2"  >
		</div>
	</form>
	
</div>

<!-- bootstrap jquery -->
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="../javascript/foto.js"></script>

</body>
</html>