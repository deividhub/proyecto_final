	<nav class="nav_genero">
		<ul class="ul_logo">
		    <li><a href="/proyecto_final/index.php/Principal">DWNPD</a></li>
		</ul>
	    <ul>
			<li class="li_activo mujer"><a href="#">Mujer<hr></a></li>
			<li class="hombre"><a href="#">Hombre<hr></a></li>
	    </ul>
	</nav>




	<nav class="nav_categorias">


	    <ul class="ul_categorias">


<?php 
$array_iconos = Array(0=>base_url()."img/camiseta.png",1=>base_url()."img/pantalon.png",2=>base_url()."img/abrigo.png",3=>base_url()."img/sudadera.png",4=>base_url()."img/zapato.png",5=>base_url()."img/gorra.png");
$contador=0;

foreach ($categorias as $key) {

?>

	        <li><a href="<?php echo base_url(); ?>index.php/Productos/mostrar_productos_tipo/<?php echo $key->id_tipo_producto; ?>"><img src="<?php echo $array_iconos[$contador]; ?>"><?php echo $key->desc_tipo_producto; ?></a>
				<ul class="ul_subcategoria">
				<?php 
					foreach ($estilos as $estilo) {
						if ($estilo->id_tipo_producto==$key->id_tipo_producto) {
							echo "<li>
								<a href=".base_url()."index.php/Productos/mostrar_productos_estilo/".$estilo->id_estilo.">".$estilo->descripcion."</a>
								</li>";
						}
					}
				?>

				</ul>
	        </li>

<?php
$contador++;
	}

 ?>

	    </ul>
	</nav>

