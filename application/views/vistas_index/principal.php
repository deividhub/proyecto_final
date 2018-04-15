	<section id="section_slogan">
      <article id="article_img">
         <h1>Proximamente...</h1>
         <button>¡Reserva las tuyas!</button>
      </article>     
	</section>


<section class="section_imagenes">

<?php 
$cont=0;
foreach ($productos_rdm as $key) {
   $imagen=$key->imagen;
   $enlace=base_url().'index.php/Productos/mostrar_producto/'.$key->id_producto;
      
?>

<a href="<?php echo $enlace; ?>" class="reversible">
   <div data-transitions="Ver producto" class="verso"></div>
   <div data-transitions="" class="cara"><img src="<?php echo $imagen; ?>" alt=""></div>
</a>
<?php
}
 ?>
</section>







<?php 
// Esto es para mostrar las imagenes de la BD
/*if ($imagen) {
   echo "string";
   foreach ($imagen as $key ) {
      echo '<img src="data:image/jpeg;base64,'.base64_encode($key->imagen).'"/>';

   }
}*/

 ?>