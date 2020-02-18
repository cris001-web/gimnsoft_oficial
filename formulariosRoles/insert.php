<?php
	if (!empty($_POST)) {
		
	 	if(!empty($_POST['rol_descripcion'])) {
	 		echo "enmtrooo";
		 		include("../config/class.conexion.php");
		 		$id=$_POST['id'];
		 		$rol_descripcion=$_POST['rol_descripcion'];
		 		
		 		
		 		
				

				$insert = "INSERT INTO roles (id,rol_descripcion) values ('$id =''','$rol_descripcion')"; 
				$resultado= mysqli_query($conexion,$insert);
					if ($resultado) {
?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  Guardado Exitos
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
				        </div>		
<?php
					}
		}		
	}
?>	 

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	
</head>
<body>
<div class="container center-block" style="margin-top: 90px;">
	<form action="insert.php" method="POST"   style="box-shadow: 1px 2px 6px 0px black; height: 280px;width: 60%;
    margin: auto;">
		
			<h2 class="text-white text-center" style="background: #6f6f6f">Formulario Rol</h2>
	
		<div class="form-group mx-2 mt-5">
			<input type="text" class="form-control" name="rol_descripcion" id="rol_descripcion" placeholder="Ingrese Rol Ej.: Administrador o Usuario">
		</div>
		<input type="submit"  value="Guardar" class="btn btn-primary btn-lg my-5 mx-2" onclick="return validarCampoRoles();">
	 
	</form>
</div>	


<!-- jquery bootstrap-->
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../validaciones/funciones_validar_rol.js"></script>
</body>
</html>
