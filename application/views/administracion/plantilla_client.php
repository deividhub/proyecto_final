<body id="administrar_cliente">

	<header>

		<ul>
		    <li>Perfíl personal</li>
		    <li><i class="material-icons rounded">person</i></li>
		    <li><a href="<?php echo base_url();?>index.php/Principal">Volver a la tienda</a></li>
		</ul>

	</header>


	<section>

		<aside>

			<ul>
			    <li><a href="">Datos personales</a></li>
			    <li><a href="">Pedidos</a></li>
			    <li><a href="">Notificar errores</a></li>
			</ul>

		</aside>

		<article id="datos_personales">

			<h1>Gestión de datos personales</h1>

			<form class="form_client">
			
				<label>Nombre: </label>
				<input type="text" id="form_nombre_cliente">

				<label>Apellidos: </label>
				<input type="text" id="form_apellidos_cliente">	

				<label>Fecha nacimiento: </label>
				<input type="date" id="form_fecha_cliente">

				<label>Domicilio: </label>
				<input type="text" id="form_domicilio_cliente">

				<label>Provincia: </label>
				<input type="text" id="form_provincia_cliente">

				<label>Localidad: </label>
				<input type="text" id="form_localidad_cliente">

				<label>Correo electrónico: </label>
				<input type="email" id="form_correo_cliente">

			</form>

			<p class="developed">Desarrollado por: Nerea - Pedro - David</p>

		</article>
	
		<!--
		<article id="pedidos">

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
		-->
	</section>

</body>
</html>





