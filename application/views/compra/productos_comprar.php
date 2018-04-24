
<section id="section_comprobando_compra">

	<section id="section_productos_compra">
		<h1>1. Tus productos</h1>
	</section>


	<section id="section_datos_usuario">
		<h1>2. Datos de facturación / envio</h1>
		<form id="form_compra_d_u">
			<input type="text" name="nc" placeholder="nombre" id="nc" readonly>
			<input type="text" name="ac" placeholder="apellidos" id="ac" readonly>
			<input type="text" name="dc" placeholder="Direccion" id="dc" readonly>
			<input type="text" name="cpc" placeholder="codigo postal" id="cpc">
			<input type="text" name="dnic" placeholder="DNI" id="dnic">
			<input type="text" name="fcc" placeholder="fecha nacimiento" id="fcc" readonly>
			<input type="text" name="pc" placeholder="provincia" id="pc" readonly>
			<input type="text" name="lc" placeholder="localidad" id="lc" readonly>

		</form>

	</section>
	<section id="section_tarjeta_pago">
		<h1>3. Tu tarjeta de crédito/débito</h1>
		<form>
			<i class="fa fa-cc-visa" id="credit_card"></i>
			<label><p>Nº Tarjeta</p><input type="text" id="credit_number" name="" value="" placeholder="4564 5643 9873 7632" required></label>
			<label><p>Titular</p><input type="text" name="" id="credit_person" placeholder="MANOLO OBESO PALOMINO" required></label>
			<div id="pago_group">
				<label><p>Expedición</p><input type="text" name="" value="" id="credit_exp" placeholder="11/19" required></label>
				<label><p>CCV</p><input type="text" name="" value="" placeholder="999" id="credit_ccv" required></label>
			</div>
					<div id="pago_group">

			<input type="checkbox" name="" id="acept_terms" required>Acepto los terminos y condiciones de compra.
		</div>
			<button type="submit" name="" id="comprar_final">Pagar</button>
		</form>
		
	</section>


	
</section>