<body>
	<header>
		<ul id="ul_administracion_header">
		    <li>Panel de Administracion</li>
		    <li><a href="<?php echo base_url();?>index.php/Principal">Volver a la tienda</a></li>
		    <li><i class="material-icons rounded">person</i></li>
		</ul>
	</header>


<section id="section_admin">

<aside id="aside_panel_admin">
	<ul>
	    <li><a href="">Usuarios</a>
	    	<ul class="submenu_panel_admin">
	    	    <li><a href="">Añadir usuario</a></li>
	    	    <li><a href="">Modificar - Eliminar usuario</a></li>
	    	</ul>
	    </li>
	    <li><a href="">Productos</a>
	    	<ul class="submenu_panel_admin">
	    	    <li><a href="">Añadir producto</a></li>
	    	    <li><a href="">Modificar - Eliminar producto</a></li>
	    	</ul>
	    </li>
	    <li><a href="">Notificar errores</a></li>
	</ul>
</aside>
	<article class="configuraciones_panel_admin">
		<h1>Gestion de productos</h1>
		<h2>Añadir un producto</h2>
		<form class="form_añadir_producto">
			<input type="text" name="" placeholder="Nombre de producto" id="form_nombre_producto">

			<select name="form_tipo_producto" id="form_tipo_producto">
				<option value="">Tipo de producto</option>
				<?php
				 if($tipos_producto){
				 	foreach ($tipos_producto as $key) {
				 		echo "<option value='".$key->id_tipo_producto."'>".$key->desc_tipo_producto."</option>";
				 	}
				} 
				?>
			</select>	

			<select name="" id="form_estilo_producto">
				<option value="0">Estilo</option>
			</select>

			<input name="text" type="" value="" placeholder="Color" id="form_color_producto"/>

			<textarea name=""placeholder="Descripcion" id="form_desc_producto"></textarea>
			<input type="number" name="" placeholder="precio" id="form_precio_producto">
			<input type="text" name="" placeholder="Composición" id="form_composicion_producto">
			<select name="" id="form_genero_producto">
				<option value="0">Género</option>
				<option value="1">Hombre</option>
				<option value="2">Mujer</option>
			</select>	
			<input type="file" name="" value="" id="form_imagen_producto">
			<input type="submit" name="" value="Crear Producto" id="btn_crear_producto">
		</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>












	<article class="configuraciones_panel_admin form_oculto">
		<h1>Gestion de productos</h1>
		<h2>Lista de productos</h2>
		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Genero</th>
						<th>Color</th>
						<th>Precio</th>
						<th>Precio anterior</th>
						<th>Descripción</th>
						<th>Estilo</th>
						<th>Composición</th>
						<th>Imagen</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if ($listado_completo_productos) {
						foreach ($listado_completo_productos as $producto) {
							$ruta_imagen= '<img src="data:image/jpeg;base64,'.base64_encode($producto->imagen).'"/>';
							echo "<tr>
								<td>".$producto->id_producto."</td>
								<td>".$producto->nombre_producto."</td>
								<td>".$producto->id_tipo_producto."</td>
								<td>".$producto->genero."</td>
								<td>".$producto->color."</td>
								<td>".$producto->precio."</td>
								<td>".$producto->precio_ant."</td>
								<td>".$producto->descripcion."</td>
								<td>".$producto->id_estilo."</td>
								<td>".$producto->composicion."</td>
								<td>".$ruta_imagen."</td>
								<td><a href='#'><i class='material-icons button edit'>edit</i></a>
						        <a href='#'><i class='material-icons button delete'>delete</i></a>
						      	</td>
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>






	<article class="configuraciones_panel_admin form_oculto">
		<h1>Gestion de usuario</h1>
		<h2>Lista de usuarios</h2>
		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Tipo</th>
						<th>Correo</th>
						<th>Fecha nacimiento</th>
						<th>Teléfono</th>
						<th>Domicilio</th>
						<th>Provincia</th>
						<th>Localidad</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if ($listado_completo_usuarios) {
						foreach ($listado_completo_usuarios as $usuario) {
							$ruta_imagen= '<img src="data:image/jpeg;base64,'.base64_encode($producto->imagen).'"/>';
							echo "<tr>
								<td>".$usuario->id_usuario."</td>
								<td>".$usuario->nombre."</td>
								<td>".$usuario->apellidos."</td>
								<td>".$usuario->id_tipo_usuario."</td>
								<td>".$usuario->correo."</td>
								<td>".$usuario->fecha_nac."</td>
								<td>".$usuario->telefono."</td>
								<td>".$usuario->domicilio."</td>
								<td>".$usuario->provincia."</td>
								<td>".$usuario->localidad."</td>
								<td><a href='#'><i class='material-icons button edit'>edit</i></a>
						        <a href='#'><i class='material-icons button delete'>delete</i></a>
						      	</td>
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>




</section>

</body>
</html>





