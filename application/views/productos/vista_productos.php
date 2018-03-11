<section id="section_todos_productos">
	
<aside id="aside_filtros">
	<form id="form_filtros">
		<select name="">
			<option value="">Color</option>
			<option value="">Rosa</option>
			<option value="">Verde</option>
			<option value="">Azul</option>
		</select>

		<select name="">
			<option value="">Talla</option>
			<option value="">XS</option>
			<option value="">M</option>
		</select>

		<label>Precio: </label>
		<input type="range" name="" min="" max="" step="" value="">
		<input type="submit" name="" value="Filtrar">
	</form>
</aside>
<aside id="aside_filtros_2">
	<select name="">
		<option value="1">Precio: De menor a mayor</option>
		<option value="2">Precio: De mayor a menor</option>
	</select>
</aside>
<section id="section_article_productos">


<?php if (!$productos) {
	echo "Actualmente no hay productos disponibles.";
} 
else{
	foreach ($productos as $producto) {
		$id_producto= $producto->id_producto;
		$precio= $producto->precio;
		$precio_ant= $producto->precio_ant;
		$imagen='"data:image/jpeg;base64,'.base64_encode($producto->imagen).'"';
	}
?>
	<article class="article_producto">
		<img class="img_hover" src=<?php echo $imagen; ?> alt="">
		<p class="precio_hover"><?php echo $precio; ?>€</p>
		<a href="<?php echo base_url().'index.php/Productos/mostrar_producto/'.$id_producto;?>">
			<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
		</a>
	</article>

<?php 
}
 ?>







	<!--<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>

	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>
	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>

	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>
	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>

	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>
	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>

	<article class="article_producto">
		<img class="img_hover" src="https://media.gucci.com/style/DarkGray_Center_0_0_800x800/1501179310/493869_0GCCT_8842_001_067_0000_Light-Bolsa-con-Cinturn-de-Piel-con-Estampado-Gucci.jpg" alt="">
		<p class="precio_hover">32,77€</p>
		<button type="button" class="btn_ver_producto">Ver producto<i class="material-icons">visibility</i></button>
	</article>-->


</section>






</section>