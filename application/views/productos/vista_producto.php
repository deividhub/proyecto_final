<section id="section_producto">
	<article class="article_producto_imagen">
<?php if (!$producto){
	echo "Este producto no está disponible";
}

$array_tallas=array();
$array_stock=array();

foreach ($producto as $key) {
	$ruta_imagen= '<img src="'.$key->imagen.'"/>';
	$nombre_producto=$key->nombre_producto;
	$id_producto=$key->id_producto;
	$precio=$key->precio;
	$genero=$key->genero;
	$desc=$key->descripcion;


	foreach ($tallas as $talla) {
		$array_tallas[$talla->id_talla]=$talla->descripcion;
		$array_stock[$talla->id_talla]=$talla->stock;

	}



?>



		<a target="_blank" href="<?php echo $key->imagen;?>"><img src="<?php echo $key->imagen;?>" alt=""></a>
		<div>
			<?php 
			if (count($favoritos)>0) {
				foreach ($favoritos as $key) {
					echo "<i id='icono_fav' class='material-icons fav-true'>favorite</i>";
				}
			}
			else{
				echo "<i id='icono_fav' class='material-icons fav-false'>favorite</i>";
			}
			 ?>
		
		</div>


	</article>
	<article class="article_datos_producto">
		<ul class="ul_datos_genericos">
		    <li class="li_titulo"><?php echo $nombre_producto; ?></li>
		    <li class="li_referencia">Referencia: <a href="#"><?php echo $id_producto; ?></a></li>
		    <li ><?php echo $genero; ?></li>
		    <li>Precio: <?php echo $precio; ?>€</li>
		    <li>Talla: 

			<?php 	
			foreach ($array_tallas as $talla => $valor) {
				if ($array_stock[$talla]==0) {
				echo "<button type='button' class='btn_talla' value='$talla' disabled>$valor</button>";
				}
				else{
					if ($valor=="Talla unica") {
						echo "<button type='button' class='btn_talla unica' value='$talla'>Única</button>";
					}
					else{
						echo "<button type='button' class='btn_talla' value='$talla'>$valor</button>";	
					}
		
				}

			}
			 ?>

		    </li>
		</ul>

		<ul id="ul_añadir_producto">
		    <li><button type="button" id="btn_añadir_carrito">Añadir al carrito</button></li>
		    <li><button type="button">¡Comprar ya!</button></li>
		</ul>
		<ul id="ul_producto_descripcion">
		    <li><h2>Descripción</h2></li>
		    <li><?php echo $desc; ?></li>
		</ul>



<?php
} 
?>
	</article>


</section>


<section id="section_desplegar_comentario">
	<h1>Comentarios</h1>
</section>

<section id="section_comentarios">
	<article id="article_poner_comentario">
		<p>Hola Manolo, ¡Comenta este producto!</p>
		<form>
			<textarea name="txt_comentario" id="txt_comentario"></textarea>


		<?php 

		if ($comentar>0) {
		echo "<button type='button' id='btn_comentar'>Comentar</button>";
		}
		else{
		echo "<button type='button' disabled>Comentar</button>";
		}
 		?>
		</form>
	</article>

	<article id="article_comentarios">
<section id="pagination">

</section>
	</article>

</section>

