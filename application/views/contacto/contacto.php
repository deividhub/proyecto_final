<section id="seccion_contacto">

	<h1>¡Contáctanos!</h1>

	<form id="contacto">
		
		<label>Nombre</label>
		<input type="text" id="nombre_contacto" placeholder="Nombre"></input>

		<label>Dirección de correo electrónico</label>
		<input type="email" placeholder="ejemplo@ejemplo.com" id="correo_contacto"></input>

		<label>Motivo de contacto</label>
		<select id="select_contacto">
			<option class="opciones_contacto">Consulta general</option>		
			<option class="opciones_contacto">Sugerencias</option>
			<option class="opciones_contacto">Informar de un problema</option>
		</select>

		<label>Mensaje</label>
		<textarea id="mensaje_contacto" placeholder="Introduzca su mensaje."></textarea>
		
		<section id="botones_contacto">			
			<button id="enviar_contacto">Enviar</button>
			<button id="limpiar_contacto">Limpiar</button>
		</section>

	</form>

</section>