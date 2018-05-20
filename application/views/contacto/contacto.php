<section id="seccion_contacto">

	<h1>¡Contáctanos!</h1>

	<form id="contacto">
		
		<label>Nombre</label>
		<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaNombreContacto" class="imgAlerta" title="" hidden="true">
		<input type="text" id="nombre_contacto" placeholder="Nombre"></input>

		<label>Dirección de correo electrónico</label>
		<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaCorreoContacto" class="imgAlerta" title="" hidden="true">
		<input type="text" placeholder="ejemplo@ejemplo.com" id="correo_contacto"></input>

		<label>Motivo de contacto</label>
		<select id="select_contacto">
			<option class="opciones_contacto">Consulta general</option>		
			<option class="opciones_contacto">Sugerencias</option>
			<option class="opciones_contacto">Informar de un problema</option>
		</select>

		<label>Mensaje</label>
		<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaMensajeContacto" class="imgAlerta" title="" hidden="true">
		<textarea id="mensaje_contacto" placeholder="Introduzca su mensaje."></textarea>
		
		<section id="botones_contacto">			
			<button id="enviar_contacto">Enviar</button>
			<button id="limpiar_contacto">Limpiar</button>
		</section>

	</form>

</section>