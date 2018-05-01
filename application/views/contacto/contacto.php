<section id="seccion_contacto">

	<h1>¡Contáctanos!</h1>

	<form id="contacto">
		
		<label>Nombre</label>
		<input type="text" placeholder="Nombre" required></input>

		<label>Dirección de correo electrónico</label>
		<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaCorreo" class="imgAlerta" title="" hidden="true">
		<input type="text" placeholder="ejemplo@ejemplo.com" required
		id="correo_contacto"></input>

		<label>Motivo de contacto</label>
		<select id="select_contacto">
			<option class="opciones_contacto">Consulta general</option>		
			<option class="opciones_contacto">Sugerencias</option>
			<option class="opciones_contacto">Informar de un problema</option>
		</select>

		<label>Mensaje</label>
		<textarea placeholder="Introduzca su mensaje." required></textarea>
		
		<button id="enviar_contacto" type="submit">Enviar</button>
		<button id="limpiar_contacto">Limpiar</button>

	</form>

</section>


<script>
	
	$("#enviar_contacto").click(function(e){
		
		var email = document.getElementById('correo_contacto').value;
		var emailReg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		
		if(emailReg.test(email)==false){
			
			$("#correo_contacto").css("border", "solid 1px red");
			document.getElementById('imgAlertaCorreo').hidden=false;
			document.getElementById('imgAlertaCorreo').title = "Correo no válido";
		}
		else{
			document.getElementById('imgAlertaCorreo').hidden=true;
		}
	}

</script>