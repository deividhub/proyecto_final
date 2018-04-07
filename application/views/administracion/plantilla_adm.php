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
	    	    <li class="mostrar" id="crear_user"><a href="">Añadir usuario</a></li>
	    	    <li class="mostrar" id="list_user"><a href="">Listado</a></li>
	    	</ul>
	    </li>
	    <li><a href="">Productos</a>
	    	<ul class="submenu_panel_admin">
	    	    <li class="mostrar" id="crear_product"><a href="">Añadir producto</a></li>
	    	    <li class="mostrar" id="list_product"><a href="">Listado</a></li>
	    	    <li class="mostrar" id="list_tipos"><a href="">Tipos</a></li>
	    	    <li class="mostrar" id="list_estilos"><a href="">Estilos</a></li>
	    	    <li class="mostrar" id="list_tallas"><a href="">Tallas</a></li>
	    	</ul>
	    </li>
	    <li class="mostrar" id="list_coments"><a href="">Comentarios</a></li>
	    <li class="mostrar" id="list_pedidos"><a href="">Pedidos</a></li>
	    <li><a href="#">Notificar errores</a></li>
	</ul>
</aside>
	<article class="configuraciones_panel_admin form_oculto crear_product">
		<h1>Gestion de productos</h1>
		<h2>Añadir un producto</h2>
		<form class="form_añadir_producto" action="Administracion/crear_producto" method="POST">
			<input type="text" name="form_nombre_producto" placeholder="Nombre de producto" id="form_nombre_producto">

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

			<select name="form_estilo_producto" id="form_estilo_producto">
				<option value="0">Estilo</option>
			</select>

			<input name="form_color_producto" type="text" value="" placeholder="Color" id="form_color_producto"/>

			<textarea name="form_desc_producto"placeholder="Descripcion" id="form_desc_producto"></textarea>
			<input type="number" name="form_precio_producto" placeholder="precio" id="form_precio_producto">
			<input type="text" name="form_composicion_producto" placeholder="Composición" id="form_composicion_producto">
			<select name="form_genero_producto" id="form_genero_producto">
				<option value="0">Género</option>
				<option value="Hombre">Hombre</option>
				<option value="Mujer">Mujer</option>
			</select>	
			<input type="file" name="files[]" value="" id="files">
			<input type="submit" name="btn_crear_producto" value="Crear Producto" id="btn_crear_producto">
		</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>



	





	<article class="configuraciones_panel_admin form_oculto list_product">
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
							$ruta_imagen= '<img src="'.$producto->imagen.'"/>';
							
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






	<article class="configuraciones_panel_admin form_oculto list_user">
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
								<td><button type='button' value='".$usuario->id_usuario."' id='edituser'><i class='material-icons button edit'>edit</i></button>
						        <button type='button' value='".$usuario->id_usuario."' class='deleteuser'><i class='material-icons button delete'>delete</i></button>
						      	</td>
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
			<form action="" method="POST" accept-charset="utf-8" id="form_editar_usuario">
				<div class="input_group">
					<label>Nombre:</label> <input type="text" name="nombre">
				</div>

				<div class="input_group">
					<label>Apellidos:</label> <input type="text" name="apellidos">
				</div>

				<div class="input_group">
				 	<label>Email:</label> <input type="text" name="correo">
				</div>
				<div class="input_group">
					<label>Fecha nacimiento:</label> <input type="text" name="fecha_nac">
				</div>
				<div class="input_group">
					<label>Telefono:</label> <input type="text" name="telefono">
				</div>
				<div class="input_group">
					<label>Domicilio:</label> <input type="text" name="domicilio">
				</div>
				<div class="input_group">
					<label>Provincia:</label> <input type="text" name="provincia">
				</div>
				<div class="input_group">
					<label>Localidad:</label> <input type="text" name="localidad">
				</div>
				<input type="hidden" name="id_usuario" value="">

				<button type="button" name="" value="" id="guardar_cambios_usuario">Guardar cambios</button>

			</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>



	<article class="configuraciones_panel_admin form_oculto crear_user">
		<h1>Gestion de usuarios</h1>
		<h2>Añadir usuario</h2>
			<form action="" method="POST" accept-charset="utf-8" id="form_crear_usuario">
				<div class="input_group">
					<label>Nombre:</label> <input type="text" name="nombre">
				</div>

				<div class="input_group">
					<label>Apellidos:</label> <input type="text" name="apellidos">
				</div>

				<div class="input_group">
				 	<label>Email:</label> <input type="text" name="correo">
				</div>
				<div class="input_group">
					<label>Fecha nacimiento:</label> <input type="text" name="fecha_nac">
				</div>
				<div class="input_group">
					<label>Telefono:</label> <input type="text" name="telefono">
				</div>
				<div class="input_group">
					<label>Domicilio:</label> <input type="text" name="domicilio">
				</div>
				<div class="input_group">
					<label>Provincia:</label> <input type="text" name="provincia">
				</div>
				<div class="input_group">
					<label>Localidad:</label> <input type="text" name="localidad">
				</div>

				<button type="button" name="" value="" id="btn_crear_usuario">Añadir usuario</button>

			</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>






<article class="configuraciones_panel_admin form_oculto list_coments">
		<h1>Lista de comentario</h1>
		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos">
				<thead>
					<tr>
						<th>#</th>
						<th>Producto</th>
						<th>Usuario</th>
						<th>Comentario</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if ($listado_completo_comentarios) {
						foreach ($listado_completo_comentarios as $comentario) {
							
							echo "<tr>
								<td>".$comentario->id_comentario."</td>
								<td>".$comentario->id_producto."</td>		
								<td>".$comentario->id_usuario."</td>
								<td>".$comentario->descripcion."</td>
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





