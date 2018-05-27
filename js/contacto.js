/*Funciones de la página de contacto*/
$(document).ready(function(){

	/*BOTÓN ENVIAR*/
	$("#enviar_contacto").click(function(e){

		e.preventDefault();

   		var mensaje="Errores encontrados: \n";
   		var comprobando=true;

   		/*Nombre*/
	    if ($("#nombre_contacto").val().length==0) {
	    	mensaje=mensaje+"El nombre no puede estar vacío.\n";
	    	comprobando=false;
			$("#nombre_contacto").css("border", "solid 1px red");
	   	}


	   	/*----------*/


	   	/*Correo*/
	    if ($("#correo_contacto").val().length==0) {
	    	mensaje=mensaje+"El correo no puede estar vacío.\n";
	    	comprobando=false;
			$("#correo_contacto").css("border", "solid 1px red");
	   	}


	   	/*----------*/


	   	/*Mensaje*/
	    if ($("#mensaje_contacto").val().length==0) {
	    	mensaje=mensaje+"El mensaje no puede estar vacío.\n";
	    	comprobando=false;
			$("#mensaje_contacto").css("border", "solid 1px red");
	   	}


	   	/*----------*/


	   	/*Si hay algún campo mal*/
   		if (comprobando==false) {

	   		/*Muestra mensaje de error*/
   			 swal("ERROR", mensaje);
   			 e.preventDefault();
   		}


   		/*Si no*/
   		else{
	
			var json={"nombre_contacto":$("#nombre_contacto").val(),"correo_contacto":$("#correo_contacto").val(),"select_contacto":$("#select_contacto").val(),"mensaje_contacto":$("#mensaje_contacto").val()}
	   		ajaxQuery("Contacto/enviar_mensaje",json)
				.then(function(devuelto){
					
				swal("¡Operación correcta!", "Mensaje enviado.", "success")
					.then((value) => {
				});	

			});
   		}
	})


	/*--------------------*/


	/*BOTÓN LIMPIAR*/
	$("#limpiar_contacto").click(function(e){
		
		e.preventDefault();

		/*Vacia el contenido de los campos*/
		$("#nombre_contacto").val("");
		$("#correo_contacto").val("");
		$("#select_contacto").val("");
		$("#mensaje_contacto").val("");
	})

});