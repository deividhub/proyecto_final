<section id="administrar_cliente">


	<section>

		<aside>

			<ul>
			    <li class="datos_personales seleccionado_cliente"><a href="#">Datos personales</a></li>
			    <li class="pedidos_cliente seleccionado_cliente"><a href="#">Pedidos</a></li>
			    <li class="favoritos_cliente  seleccionado_cliente"><a href="#">Favoritos</a></li>
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
					<select name="provincia" id="form_provincia_cliente">
					</select>

					<label>Localidad: </label>
					<select name="localidad" id="form_localidad_cliente">
					</select>

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

				<h1>Estos son tus pedidos</h1>

				<div class="tabla_scroll">
					<table id="pedido_cliente_tabla" class="tabla_muestra_elementos">
					
						<thead>
							<th>Nº Pedido</th>
							<th>Fecha</th>
							<th>Estado</th>
							<th>Precio total</th>
							<th>Mostrar productos</th>
						</thead>

						<tbody>
							
						</tbody>				

					</table>
				</div>

				<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
				
			</article>
		
		<!-- FIN PEDIDOS -->


		<!-------------------------------->

		
		<!-- FAVORITOS -->

			<article id="favoritos_cliente" class="ocultar_cliente">

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