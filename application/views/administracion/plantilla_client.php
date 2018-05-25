<section id="administrar_cliente">


	<section>

		<aside>

			<ul>
			    <li><a href="#">Datos personales</a></li>
			    <li><a href="#">Pedidos</a></li>
			    <li><a href="#">Comentarios</a></li>
			    <li class="favoritos_cliente"><a href="#">Favoritos</a></li>
			    <li><a href="<?php echo base_url();?>index.php/Principal/contacto">Contacto</a></li>
			</ul>

		</aside>
		

		<!-- DATOS PERSONALES -->

			<article id="datos_personales" class="ocultar_cliente">

				<h1>Gestión de datos personales</h1>

				<form class="form_client" id="form_client">
				
					<label>Nombre: </label>
					<input type="text" id="form_nombre_cliente" name="nombre">

					<label>Apellidos: </label>
					<input type="text" id="form_apellidos_cliente" name="apellidos">	

					<label>Fecha nacimiento: </label>
					<input type="date" id="form_fecha_cliente" name="fecha_nac">

					<label>Domicilio: </label>
					<input type="text" id="form_domicilio_cliente" name="domicilio">

					<label>Provincia: </label>
					<input type="text" id="form_provincia_cliente" name="provincia">

					<label>Localidad: </label>
					<input type="text" id="form_localidad_cliente" name="localidad">

					<label>Correo electrónico: </label>
					<input type="email" id="form_correo_cliente" name="correo">

					<label>Teléfono: </label>
					<input type="text" id="form_telefono_cliente" name="telefono">
					<input type="hidden" name="id_usuario" id="id_usuario">
					
					<section>
						<button type='submit' id="btn_guardar_datos">Guardar</button>				
						<button type='button' id="btn_rec_contraseña">Cambiar contraseña</button>						
					</section>			

				</form>

				<p class="developed">&copy DWNPD ~ 2018</p>

			</article>
		
		<!-- FIN DATOS PERSONALES -->


		<!-------------------------------->

		
		<!-- PEDIDOS -->
			
			<article id="pedidos_cliente" class="ocultar_cliente">

				<h1>Gestión de pedidos</h1>

				<form class="form_client">
				
					<input type="text" id="form_nombre_cliente">

					<input type="text" id="form_apellidos_cliente">	

					<input type="date" id="form_fecha_cliente">

					<input type="text" id="form_domicilio_cliente">

					<input type="text" id="form_provincia_cliente">

					<input type="text" id="form_localidad_cliente">

					<input type="email" id="form_correo_cliente">

				</form>

				<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
				
			</article>
		
		<!-- FIN PEDIDOS -->


		<!-------------------------------->

		
		<!-- COMENTARIOS -->

			<article id="comentarios_cliente" class="ocultar_cliente">

				<h1>Gestión de pedidos</h1>

				<form class="form_client">
				
					<input type="text" id="form_nombre_cliente">

					<input type="text" id="form_apellidos_cliente">	

					<input type="date" id="form_fecha_cliente">

					<input type="text" id="form_domicilio_cliente">

					<input type="text" id="form_provincia_cliente">

					<input type="text" id="form_localidad_cliente">

					<input type="email" id="form_correo_cliente">

				</form>

				<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
				
			</article>
		
		<!-- FIN COMENTARIOS -->


		<!-------------------------------->

		
		<!-- FAVORITOS -->

			<article id="favoritos_cliente" >

				<h1>Estos son los productos que te han gustado</h1>

				<article id="productos_favoritos">
					
					<article id="productos_favoritos_scroll">
						
						

					</article>

				</article>

				<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
				
			</article>
		
		<!-- FIN FAVORITOS -->		

	</section>

</section>