	<nav class="nav_genero">
		<ul class="ul_logo">
		    <li><a href="/proyecto_final/index.php/Principal">DWNPD</a></li>
		</ul>
	    <ul>
	    	<?php 
	    	if(isset($genero)){
	    		if($genero=="hombre"){
				echo "<li class='mujer'><a href='#'>Mujer<hr></a></li>";
				echo "<li class='hombre li_activo'><a href='#'>Hombre<hr></a></li>";
	    		}
	    		else{
				echo "<li class='mujer li_activo'><a href='#'>Mujer<hr></a></li>";
				echo "<li class='hombre'><a href='#'>Hombre<hr></a></li>";
	    		}
	    	} 
	    	else{
				echo "<li class='mujer'><a href='#'>Mujer<hr></a></li>";
				echo "<li class='hombre'><a href='#'>Hombre<hr></a></li>";
	    	}
	    	?>

	    </ul>
	</nav>




	<nav class="nav_categorias">


	    <ul class="ul_categorias">


<?php 
foreach ($categorias as $key) {

?>

	        <li><a href="<?php echo base_url(); ?>index.php/Productos/mostrar_productos_tipo/<?php echo $key->id_tipo_producto; ?>"><?php echo $key->desc_tipo_producto; ?></a>
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
	}

 ?>

	    </ul>
	</nav>

