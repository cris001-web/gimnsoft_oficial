<?php 
include("../config/class.conexion.php");
	$query_select="SELECT rol_descripcion FROM roles";
	$ejecutar=mysqli_query($conexion,$query_select);
		$msj='';
		if (!empty($_POST)) {

		

			$email=$_POST['email'];
			$contraseña=md5($_POST['contraseña']);
			$activo=$_POST['activo'];
			$rol_id=$_POST['rol_id'];
			$nombre_usuario=$_POST['nombre_usuario'];

			$nombre=$_POST['nombre'];
			$apellido=$_POST['apellido'];
			$calle=$_POST['calle'];
			$barrio=$_POST['barrio'];
			$localidad=$_POST['localidad'];
			//echo 'id'. $rol_id; id del rol seleccionado
			//verifico si el email ya esta registrado
			$var_seguir=0;
			$query_verifico=mysqli_query($conexion,"SELECT * FROM usuarios where email='$email' OR nombre_usuario='$nombre_usuario' ");
			$filas_contador=mysqli_num_rows($query_verifico);
			
				if ($filas_contador>0) {
					echo('<p class="alert alert-warning alert-dismissible fade show">NOMBRE DEL USUARIO O EMAIL YA REGISTRADO</p>');
				
				
				}else{

					//creo usuario
					$query_insertar=mysqli_query($conexion,"INSERT INTO usuarios(email,contraseña,activo,rol_id,nombre_usuario) VALUES ('$email', '$contraseña','$activo','$rol_id','$nombre_usuario')");
					//si insertar usuario esta correcto obtengo id de usuario
					if($query_insertar){
						$var_seguir=1;
						//a
						echo "GUARDADO USUARIO". '</br>';
						//va seguir
						if ($var_seguir==1) {
							//selecciono id
							$query_selectID=mysqli_query($conexion,"SELECT id FROM usuarios WHERE nombre_usuario='$nombre_usuario'");
								while ($select_id_usuario=mysqli_fetch_array($query_selectID)) {
									$var_usuario_id=$select_id_usuario[0];
									echo 'variable dekl usuario guardada id'.$var_usuario_id. '</br>';
								}
								//codigo de foto
								$nombre_imagen=$_FILES['imagen']['name'];
								$tipo_imagen  =$_FILES['imagen'] ['type'];
								$tamagno_imagen  =$_FILES['imagen'] ['size'];

								$carpeta_destino=$_SERVER['DOCUMENT_ROOT']. '../gimnsoftware/uploads/';
								move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);
							
								//inserto cliente con id de usuario
								$query_insertar_cli=mysqli_query($conexion,"INSERT INTO clientes (nombre,apellido,calle,barrio,localidad,usuario_id,foto) VALUES ('$nombre','$apellido','$calle','$barrio','$localidad','$var_usuario_id','$nombre_imagen')");

								echo("INSERT INTO clientes (nombre,apellido,calle,barrio,localidad,usuario_id) VALUES ('$nombre','$apellido','$calle','$barrio','$localidad','$var_usuario_id','$nombre_imagen')");

								if ($query_insertar_cli) {
									echo('<p class="alert alert-success alert-success fade show">OPERACIÓN EXITOSA. GUARDADO EXISITOSAMENTE</p>');
								}else{
									echo('<p class="alert alert-warning alert-success fade show">OPERACIÓN SIN EXITO. NO SE PUDO GUARDAR</p>');
								}
						}else{
							echo "no entro en var seguir";
						}
						//va seguir

					//a
					}else{
						//a
						echo "NO SE GUARDO USUARIO". '</br>';
					}
				}
				
		}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Insertar Usuarios</title>
<!-- bootstrap -->
<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">	
<link rel="stylesheet" type="text/css" href="../style/estilo_foto.css">
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>

</head>
<body>
<div class="container center-block" style="margin-top: 90px;">
	<form action="insertar_usuarios.php" method="POST" style="box-shadow: 1px 2px 6px 0px black; height: 500px;width: 60%;
    margin: auto;" enctype="multipart/form-data">
		<h2 class="text-white text-center" style="background: #6f6f6f">Insertar Usuarios</h2>

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