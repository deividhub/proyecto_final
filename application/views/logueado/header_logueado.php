<body>
	<header  id="header_logueado">
		<ul id="index_ul">
		    <li><a href="#">Envio gratuito a partir de 40€</a></li>
		    <li><a href="#">Promociones verano</a></li>
		    <li><a href="<?php echo base_url();?>index.php/Principal/contacto">Contacto</a></li>
		</ul>
		<ul id="ul_index_logueado">
			<li id="drop_menu"><a href="#"><i class="material-icons">menu</i></a></li>
			<li id="movil_logo"><a href="#">DWNPD</a></li>
		    <li class="icon_logueado" id="log_perfil"><a href="<?php echo base_url();?>index.php/Principal/perfil_usuario/id_usuario"><i class="material-icons">person</i><span class="tooltiptext">Visita tu perfil</span></a></li>

		    <li class="icon_logueado" id="ver_carrito"><a href="#" ><i  class="material-icons">shopping_cart</i></a>




				<div id="carrito">
					<header class="carrito_header">
						Mi carrito
					</header>
					<section class="section_creacion_articulos">

					</section>	
					<ul id="ul_carrito_total">

					    <li>Precio total:<a href="#" id="carrito_precio_total"> 0</a>€</li>
					    <li><button id="btn_pasar_a_caja" type="button">Pasar por caja</button></li>
					</ul>
				</div>
			</li>
			<li class="cerrar_sesion">Cerrar sesion</li>
		</ul>
	</header>

