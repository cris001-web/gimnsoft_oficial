function validarCampoRoles() {

	$('.mensaje').remove();
	//declaro variable
	var rol_descripcion = $('#rol_descripcion').val();
	
	//alert(rol_descripcion);

	
	//valido que no este vacio
	var expresNum= /^[a-zA-Z ]*$/;
	if (rol_descripcion=='' || rol_descripcion==null) {
		//alert('no debe estae en blanco')
		cambiarColor('rol_descripcion');
		mostrarMsj('El Campo no debe estar vacio','rol_descripcion');
		return false;
	}else if (!expresNum.test(rol_descripcion)) {
		cambiarColor('rol_descripcion');
		mostrarMsj('Debe ingresar solo letras','rol_descripcion');
		return false;
				
	} 
	
}
//funcion para validar campo en usuario y cliente
function validarCampoUsuarios() {
	$('.mensaje').remove();

	//declaro variable
	var email = $('#email').val();
	var contraseña = $('#contraseña').val();
	var nombre_usuario = $('#nombre_usuario').val();

	var nombre = $('#nombre').val();
	var apellido = $('#apellido').val();
	var calle = $('#calle').val();
	var localidad = $('#localidad').val();
	
	var expresNum= /^[a-zA-Z ]*$/;
	//valido email que no este vacio
	if (nombre_usuario=='' ) {
		cambiarColor('nombre_usuario');
		mostrarMsj('El Campo no debe estar vacio','nombre_usuario');
		//return false;
	}else if (!expresNum.test(nombre_usuario)) {
		cambiarColor('nombre_usuario');
		mostrarMsj('Debe ingresar solo letras','nombre_usuario');
		//return false;
				
	} 
	if (email=='' ) {
		cambiarColor('email');
		mostrarMsj('El Campo no debe estar vacio','email');
		//return false;
	}
	if (contraseña=='' ) {
		cambiarColor('contraseña');
		mostrarMsj('El Campo no debe estar vacio','contraseña');
		//return false;
	}

	if (nombre_usuario=='' ) {
		cambiarColor('nombre');
		mostrarMsj('El Campo no debe estar vacio','nombre');
		//return false;
	}else if (!expresNum.test(nombre_usuario)) {
		cambiarColor('nombre');
		mostrarMsj('Debe ingresar solo letras','nombre');
		//return false;
				
	} 
	if (apellido=='' ) {
		cambiarColor('apellido');
		mostrarMsj('El Campo no debe estar vacio','apellido');
		//return false;
	}else if (!expresNum.test(apellido)) {
		cambiarColor('apellido');
		mostrarMsj('Debe ingresar solo letras','apellido');
		//return false;
				
	} 
	if (calle=='' ) {
		cambiarColor('calle');
		mostrarMsj('El Campo no debe estar vacio','calle');
		//return false;
	}
	if (localidad=='' ) {
		cambiarColor('localidad');
		mostrarMsj('El Campo no debe estar vacio','localidad');
		return false;
	}
}
function cambiarColor(vari){
	//alert('entro cambiar color');
	
		$('#' + vari).css({
			border: "1px solid #dd5144"

		});
}

        //funcion mostrar campo
		function mostrarMsj(mens,campo){
			$('#' + campo).before('<div class="mensaje text-danger ">'+mens+'</div>');

		}