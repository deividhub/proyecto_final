<body id="body_admin">
	<header>
		<ul id="ul_administracion_header">
		    <li>Panel de Administracion</li>
			<li id="drop_menu_admin"><i class="material-icons">menu</i></li>
		    <li><a href="<?php echo base_url();?>index.php/Principal">Volver a la tienda</a></li>
		    <li><i class="material-icons exit-app">exit_to_app</i></li>
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
	    	    <li class="mostrar" id="list_stock"><a href="">Stock</a></li>
	    	</ul>
	    </li>
	    <li class="mostrar" id="list_coments"><a href="">Comentarios</a></li>
	    <li ><a href="#">Pedidos</a>
	    	<ul class="submenu_panel_admin">
	    	    <li class="mostrar" id="list_pedidos"><a href="">Listado</a></li>
	    	    <li class="mostrar" id="list_estados"><a href="">Estados</a></li>
	    	</ul>
	    </li>
	</ul>
</aside>
	<article class="configuraciones_panel_admin form_oculto crear_product">
		<h1>Gestion de productos</h1>
		<h2>Añadir un producto</h2>
		<form class="form_añadir_producto" action="Administracion/crear_producto" method="POST">
			
				<div class="input_group">
					<label>Nombre de producto</label> 
					<input type="text" name="form_nombre_producto" placeholder="Nombre de producto" id="form_nombre_producto">
				</div>
				<div class="input_group">
					<label>Tipo de producto</label> 
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
				</div>
				<div class="input_group">
					<label>Estilo de producto</label> 
					<select name="form_estilo_producto" id="form_estilo_producto">
						<option value="0">Estilo</option>
					</select>
				</div>
				<div class="input_group">
					<label>Color</label> 
					<input name="form_color_producto" type="text" value="" placeholder="Color" id="form_color_producto"/>
				</div>
				<div class="input_group">
					<label>Descripción (mínimo 10 caracteres)</label> 
					<textarea name="form_desc_producto" placeholder="Descripcion" id="form_desc_producto"></textarea>
				</div>
				<div class="input_group">
					<label>Precio</label> 
					<input type="number" name="form_precio_producto" placeholder="precio" id="form_precio_producto">
				</div>
				<div class="input_group">
					<label>Composición </label> 
					<input type="text" name="form_composicion_producto" placeholder="Composición" id="form_composicion_producto">				
				</div>							
				<div class="input_group">
					<label>Género</label> 
					<select name="form_genero_producto" id="form_genero_producto">
						<option value="0">Género</option>
						<option value="Hombre">Hombre</option>
						<option value="Mujer">Mujer</option>
					</select>				
				</div>

				<div class="input_group">
					<label>Imagen</label> 		
					<input type="file" name="files[]" value="" id="files">				
				</div>				

			
			
			
			
			<input type="submit" name="btn_crear_producto" value="Crear Producto" id="btn_crear_producto">
		</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>







	<article class="configuraciones_panel_admin form_oculto list_product">
		<h1>Gestion de productos</h1>
		<h2>Lista de productos</h2>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="0" placeholder="Busca por 'Nombre'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_0">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Genero</th>
						<th>Color</th>
						<th>Precio</th>
						<th>Precio en oferta</th>
						<th>Descripción</th>
						<th>Estilo</th>
						<th>Composición</th>
						<th>Imagen</th>
						<th>Estado</th>
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
								<td>".$producto->estado."</td>
								<td><button type='button' value='".$producto->id_producto."' id='editproduct'><i class='material-icons button edit'>edit</i></button>
						        <button type='button' value='".$producto->id_producto."' class='deleteproduct'><i class='material-icons button delete'>delete</i></button>
						      	</td>
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<form action="" method="POST" accept-charset="utf-8" id="form_editar_producto" class="edit_form">
				<h1>Edición de producto</h1>
				<div class="input_group">
					<label>Nombre:</label> <input type="text" name="nombre_producto">
				</div>

				<div class="input_group">
										<label>Género:</label> 

					<select name="genero">
						<option value="0">Selecciona un genero</option>
						<option value="Hombre">Hombre</option>
						<option value="Mujer">Mujer</option>
					</select>
				</div>

				<div class="input_group">
				 	<label>Tipo de producto:</label> <input type="text" name="id_tipo_producto">
				</div>
				<div class="input_group">
					<label>Color</label> <input type="text" name="color">
				</div>
				<div class="input_group">
					<label>Precio:</label> <input type="number" name="precio">
				</div>
				<div class="input_group">
					<label>Precio oferta:</label> <input type="number" name="precio_oferta">
				</div>
				<div class="input_group">
					<label>Descripción:</label> <input type="text" name="descripcion">
				</div>
				<div class="input_group">
					<label>Estilo:</label> <input type="text" name="id_estilo">
				</div>
				<div class="input_group">
					<label>Composición:</label> <input type="text" name="composicion">
				</div>
				<div class="input_group">
					<label>Imagen</label><input type="file" name="files[]" value="" id="filesimg">
				</div>
				<input type="hidden" name="id_producto" value="">
				<button type="button" name="" value="" id="guardar_cambios_producto">Guardar cambios</button>

			</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>






	<article class="configuraciones_panel_admin form_oculto list_user">
		<h1>Gestion de usuario</h1>
		<h2>Lista de usuarios</h2>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="1" placeholder="Busca por 'Correo'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_1">
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
						<th>Estado</th>
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
								<td>".$usuario->estado."</td>
								<td><button type='button' value='".$usuario->id_usuario."' id='edituser'><i class='material-icons button edit'>edit</i></button>
						        <button type='button' value='".$usuario->id_usuario."' class='deleteuser'>
						        	<i class='material-icons button delete'>delete</i>
						        </button>
						        <button type='button' class='restore_pass' value='".$usuario->id_usuario."'>
						        	<i class='material-icons'>security</i>
						        </button>
						      	</td>
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
			<form action="" method="POST" accept-charset="utf-8" id="form_editar_usuario" class="edit_form">
				<h1>Edición de usuario</h1>

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
					<label>Provincia:</label> <select id="provini" name="provincia"></select>
				</div>
				<div class="input_group">
					<label>Localidad:</label><select id="loquini" name="localidad"></select>
					
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
					<label>Nombre:</label> <input type="text" name="nombre" placeholder="Nombre">
				</div>

				<div class="input_group">
					<label>Apellidos:</label> <input type="text" name="apellidos" placeholder="Apellidos">
				</div>

				<div class="input_group">
				 	<label>Email:</label> <input type="email" name="correo" placeholder="ejemplo@ejemplo.com">
				</div>
				<div class="input_group">
					<label>Fecha nacimiento:</label> <input type="date" name="fecha_nac" placeholder="23/01/1990">
				</div>
				<div class="input_group">
					<label>Telefono:</label> <input type="text" name="telefono" placeholder="666666666">
				</div>
				<div class="input_group">
					<label>Domicilio:</label> <input type="text" name="domicilio" placeholder="C/Kalea Nº20 1ºA">
				</div>
				<div class="input_group">
					<label>Provincia:</label><select name="provincia" id="prove"></select>
				</div>
				<div class="input_group">
					<label>Localidad:</label><select name="localidad" id="loque"></select>
				</div>

				<button type="button" name="" value="" id="btn_crear_usuario">Añadir usuario</button>

			</form>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>






<article class="configuraciones_panel_admin  list_coments form_oculto">
		<h1>Lista de comentario</h1>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="2" placeholder="Busca por 'Usuario'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_2">
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
								<td><button type='button' value='".$comentario->id_comentario."' class='deletecomment'><i class='material-icons button delete'>delete</i></button>
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




<article class="configuraciones_panel_admin list_pedidos form_oculto">
		<h1>Lista de pedidos</h1>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="3" placeholder="Busca por 'ID Usuario'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_3">
				<thead>
					<tr>
						<th>#</th>
						<th>Id Usuario</th>
						<th>Importe</th>
						<th>Fecha</th>
						<th>Estado del pedido</th>
						<th>Actualizar estado</th>
						<th>Cancelar pedido</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if($estados_pedido){
						$estados="";
						foreach ($estados_pedido as $key) {
							$estados=$estados."<option value=".$key->id_estado.">Paso ".$key->id_estado."-".$key->desc_estado."</option>";
						}
					}
					if ($listado_completo_pedidos) {
						foreach ($listado_completo_pedidos as $pedido) {
							
							echo "<tr>
								<td>".$pedido->id_pedido."</td>
								<td>".$pedido->id_usuario."</td>		
								<td>".$pedido->precio_total."</td>
								<td>".$pedido->fecha_pedido."</td>
								<td class='td_pedido_$pedido->id_pedido'><select disabled id='select_modificar_pedido'><option value=$pedido->id_estado>Paso ".$pedido->id_estado."-".$pedido->desc_estado."</option>".$estados."</select></td>
								<td><i class='material-icons icon_actualizar_estado' id='td_pedido_$pedido->id_pedido'>update</i></td>
								<td><i class='material-icons icon_bloquear_estado' id='td_pedido_$pedido->id_pedido'>error</i></td>
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>






<article class="configuraciones_panel_admin list_estados form_oculto">
		<h1>Lista de estados de un pedido</h1>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="4" placeholder="Busca por 'Descripción'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_4">
				<thead>
					<tr>
						<th>#</th>
						<th>Descripción del estado</th>
					</tr>
				</thead>
				<tbody>
				<?php 

					if($estados_pedido){
						foreach ($estados_pedido as $key) {
							
							echo "<tr>
								<td>".$key->id_estado."</td>
								<td>".$key->desc_estado."</td>		
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>



<article class="configuraciones_panel_admin list_estilos form_oculto">
		<h1>Lista de estilos</h1>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="5" placeholder="Busca por 'Descripción'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_5">
				<thead>
					<tr>
						<th>#</th>
						<th>Tipo de producto asociado</th>
						<th>Descripción</th>
					</tr>
				</thead>
				<tbody>
				<?php 

					if($estilos){
						foreach ($estilos as $key) {
							
							echo "<tr>
								<td>".$key->id_estilo."</td>
								<td>".$key->id_tipo_producto."</td>		
								<td>".$key->descripcion."</td>		
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>


<article class="configuraciones_panel_admin list_tipos form_oculto">
		<h1>Lista de tipos de productos</h1>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="6" placeholder="Busca por 'Descripción'">
			<i class="material-icons">find_in_page</i>
		</div>		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_6">
				<thead>
					<tr>
						<th>#</th>
						<th>Descripción</th>
					</tr>
				</thead>
				<tbody>
				<?php 

					if($tipo_producto){
						foreach ($tipo_producto as $key) {
							
							echo "<tr>
								<td>".$key->id_tipo_producto."</td>
								<td>".$key->desc_tipo_producto."</td>		
							</tr>";
						}
					}

				 ?>	
				</tbody>
			</table>
		</article>
		<p class="developed">Desarrollado por: Nerea - Pedro - David</p>
	</article>

<article class="configuraciones_panel_admin list_stock form_oculto">
		<h1>Stock por producto</h1>
		<div id="search_div">
			<input type="text" name=""  class="search-input" id="7" placeholder="Busca por 'Nombre'">
			<i class="material-icons">find_in_page</i>
		</div>
		<article class="tabla_scroll">
			<table class="tabla_muestra_elementos" id="table-search_7">
				<thead>
					<tr>
						<th>#</th>
						<th>Talla</th>
						<th>ID producto</th>
						<th>Nombre</th>
						<th>Stock</th>
						<th>Reponer Stock</th>
					</tr>
				</thead>
				<tbody>
				<?php 

					if($stock_productos){
						foreach ($stock_productos as $key) {
							
							echo "<tr>
								<td>".$key->id_talla_producto."</td>
								<td>".$key->descripcion."</td>
								<td>".$key->id_producto."</td>
								<td>".$key->nombre_producto."</td>		
								<td>".$key->stock."</td>		
								<td><i class='material-icons upload-icon' id='$key->id_talla_producto'>cloud_upload</i></td>		
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





