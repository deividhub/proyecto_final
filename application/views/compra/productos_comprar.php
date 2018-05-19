
<section id="section_comprobando_compra">

	<section id="section_productos_compra">
		<h1> 1. Tu cesta</h1>
	</section>


	<section id="section_datos_usuario">
		<h1> 2. Datos de facturación/envío</h1>
		<form id="form_compra_d_u">
			<label>Nombre</label>
			<input type="text" name="nc" placeholder="Nombre" id="nc" readonly>
			
			<label>Apellidos</label>
			<input type="text" name="ac" placeholder="Apellidos" id="ac" readonly>
			
			<label>Dirección</label>
			<input type="text" name="dc" placeholder="Dirección" id="dc" readonly>
			
			<label>Código postal</label>
			<input type="text" name="cpc" placeholder="Código postal" id="cpc">
			
			<label>DNI</label>
			<input type="text" name="dnic" placeholder="DNI" id="dnic">
			
			<label>Fecha nacimiento</label>
			<input type="text" name="fcc" placeholder="Fecha nacimiento" id="fcc" readonly>
			
			<label>Provincia</label>
			<input type="text" name="pc" placeholder="Provincia" id="pc" readonly>
			
			<label>Localidad</label>
			<input type="text" name="lc" placeholder="Localidad" id="lc" readonly>

		</form>

	</section>
	<section id="section_tarjeta_pago">
		<h1> 3. Tu tarjeta de crédito/débito</h1>
		<form>
			<article id="tarjetas">
				<i class="fa fa-cc-visa credit_card"></i>
				<i class="fa fa-cc-mastercard credit_card"></i>
				<i class="fa fa-cc-amex credit_card"></i>
				<i class="fa fa-cc-discover credit_card"></i>
			</article>

			<label><p>Nº Tarjeta</p>
				<input type="text" id="credit_number" name="" value="" placeholder="4564 5643 9873 7632" required>
			</label>

			<label>
				<p>Titular</p>
				<input type="text" name="" id="credit_person" placeholder="MANOLO OBESO PALOMINO" required>
			</label>

			<div id="pago_group">
				<label>
					<p>Expedición</p>
					<input type="text" name="" value="" id="credit_exp" placeholder="11/19" required>
				</label>

				<label>
					<p>CCV</p>
					<input type="text" name="" value="" placeholder="999" id="credit_ccv" required>
				</label>
			</div>

			<div id="pago_group">
				<input type="checkbox" name="" id="acept_terms" required>Acepto los terminos y condiciones de compra. *
			</div>
			<a  href="#" class="comprar_final">
				<button type="button" name="" id="comprar_final">Realizar pedido</button>
			</a>
		</form>
		<p class="terms">* Los datos personales que nos aporte serán objeto de tratamiento en un fichero con las finalidades de, entre otros supuestos que se podrán especificar en cada caso, atender las solicitudes que nos plantee, remitirle la información solicitada, así como en su caso, gestionar su acceso a determinados servicios o funcionalidades del Sitio Web, por parte de DWNPD S.A., con domicilio social en Calle Kalea, Edificio 101, 48001, Bilbao (España).</p>
	</section>


	
</section>