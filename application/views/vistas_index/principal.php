	<section id="section_slogan">
      <article id="article_img">
      </article>  
      <p id="left">LEFT</p>
      <ul>
           <li>
               <img src="../img/slider1.jpg" />
               <span>
                   <h4>Colección Mujer</h4>
                   <p>¡Mid season sale!</p>
               </span>
           </li>

           <li>
               <img src="../img/slider2.jpg" />
               <span>
                   <h4>Colección Hombre</h4>
                   <p>¡Mid season sale!</p>
               </span>
           </li>

           <li>
               <img src="../img/slider3.jpg" />
               <span>
                   <h4>Colección Verano</h4>
                   <p>¡Llega el verano a nuestra tienda!</p>
               </span>
           </li>
       </ul>  
       <p>RIGHT</p>
	</section>

<section class="section_imagenes">

<?php 
$cont=0;
foreach ($productos_rdm as $key) {
   $imagen=$key->imagen;
   $enlace=base_url().'index.php/Productos/mostrar_producto/'.$key->id_producto;
   $precio=$key->precio;
      
?>

<a href="<?php echo $enlace; ?>" class="reversible">
   <div data-transitions="Ver producto <?php echo $precio;?>€" class="verso"></div>
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