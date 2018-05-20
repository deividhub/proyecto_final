/*Funciones de la página de contacto*/
$(document).ready(function(){

	/*BOTÓN ENVIAR*/
	$("#enviar_contacto").click(function(e){

		e.preventDefault();

   		var mensaje="Errores encontrados: \n";
   		var comprobando=true;

   		/*Nombre*/
	    if ($("#nombre_contacto").val().length==0) {
	    	alert("d");
	    	mensaje=mensaje+"El nombre no puede estar vacío.\n";
	    	comprobando=false;
			$("#nombre_contacto").css("border", "solid 1px red");
			document.getElementById('imgAlertaNombreContacto').hidden=false;
			document.getElementById('imgAlertaNombreContacto').title = "Nombre no válido";
	   	}


	   	/*----------*/


	   	/*Correo*/
	    if ($("#correo_contacto").val().length==0) {
	    	mensaje=mensaje+"El correo no puede estar vacío.\n";
	    	comprobando=false;
			$("#correo_contacto").css("border", "solid 1px red");
			document.getElementById('imgAlertaCorreoContacto').hidden=false;
			document.getElementById('imgAlertaCorreoContacto').title = "Correo no válido";
	   	}

		var emailReg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			
		else if(emailReg.test($("#correo_contacto").val())==false){
				
	    	mensaje=mensaje+"El correo tiene que tener el formato correcto (ejemplo@ejemplo.com).\n";
	    	comprobando=false;
			$("#correo_contacto").css("border", "solid 1px red");
			document.getElementById('imgAlertaCorreoContacto').hidden=false;
			document.getElementById('imgAlertaCorreoContacto').title = "Correo no válido";
		}


	   	/*----------*/


	   	/*Mensaje*/
	    if ($("#mensaje_contacto").val().length==0) {
	    	mensaje=mensaje+"El mensaje no puede estar vacío.\n";
	    	comprobando=false;
			$("#mensaje_contacto").css("border", "solid 1px red");
			document.getElementById('imgAlertaMensajeContacto').hidden=false;
			document.getElementById('imgAlertaMensajeContacto').title = "Mensaje no válido";
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
						form_anterior("#contacto")
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