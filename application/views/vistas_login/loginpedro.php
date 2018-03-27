<?php

//-------------FORMULARIO LOGIN-------------------
	$form_login = array(
		'name' => 'form_login'
		);
	$correo_login = array(	
		'name' => 'correo',
		'placeholder' => 'Escriba su correo',
		'maxlength' => 30,
		'size' => 30,
		'required' => 1
		);
	$contraseña_login = array(	
		'name' => 'contraseña',
		'type' => 'password',
		'placeholder' => 'Contraseña',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1
		);

//-------------FORMULARIO REGISTRO----------------
	$form_registro = array(
		'name' => 'form_registro'
		);
	$correo = array(	
		'name' => 'correo',
		'placeholder' => 'Escriba su correo',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'onkeyup' => 'verifCorreo(this.value)'
		);
	$contraseña1 = array(	
		'name' => 'contraseña1',
		'id' => 'contraseña1',
		'type' => 'password',
		'placeholder' => 'Escriba su nueva contraseña',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'onkeyup' => 'verifContraseñas(this.value)'
		);
	$contraseña2 = array(	
		'name' => 'contraseña2',
		'id' => 'contraseña2',
		'type' => 'password',
		'placeholder' => 'Escríbala de nuevo',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'onkeyup' => 'verifContraseñas2(this.value)'
		);
	$nombre = array(	
		'name' => 'nombre',
		'placeholder' => 'Escriba su nombre',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1
		);
	$apellidos = array(	
		'name' => 'apellidos',
		'placeholder' => 'Escriba sus apellidos',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1
		);
	$fecha_nac = array(	
		'name' => 'fecha_nac',
		'type' => 'date',
		'required' => 1
		);
	$telefono = array(	
		'name' => 'telefono',
		'placeholder' => 'Escriba su teléfono',
		'maxlength' => 9,
		'size' => 20,
		'required' => 1
		);
	$domicilio = array(	
		'name' => 'domicilio',
		'placeholder' => 'Escriba su domicilio',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1
		);
	$provincia = array(	
		'name' => 'provincia',
		'placeholder' => 'Escriba su provincia',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1
		);
	$localidad = array(	
			'name' => 'localidad',
			'placeholder' => 'Escriba su localidad',
			'maxlength' => 20,
			'size' => 20,
			'required' => 1
			);

?>
<div>

<!-- FORMULARIO LOGIN -->
	<?php// $url_login = base_url().'Principal/iniciar_sesion';?>
	<h3>Loguéate</h3>
	<?php echo form_open('Principal/iniciar_sesion',$form_login);?>
	
	<?php echo form_label('Correo: ','correo'); ?>
	<?php echo form_input($correo_login); ?>
	<br>
	<?php echo form_label('Password: ','contraseña'); ?>
	<?php echo form_input($contraseña_login); ?>
	<br>	
	<?php echo form_submit('Entrar','Entrar'); ?>
	<?php echo form_close();?>
	<br>


<!-- FORMULARIO REGISTRO -->
	<h3>¿No tienes cuenta?, Regístrate</h3>
	<?php echo form_open('Principal/registro',$form_registro);?>

	<?php echo form_label('Correo: ','correo'); ?>
	<?php echo form_input($correo); ?>
	<span id="mensajeCorreo"></span>
	<br>
	<?php echo form_label('Contraseña: ','contraseña1'); ?>
	<?php echo form_input($contraseña1); ?>
	<br>
	<?php echo form_label('Repita su contraseña: ','contraseña2'); ?>
	<?php echo form_input($contraseña2); ?>
	<br>
	<?php echo form_label('Nombre: ','nombre'); ?>
	<?php echo form_input($nombre); ?>
	<br>
	<?php echo form_label('Apellidos: ','apellidos'); ?>
	<?php echo form_input($apellidos); ?>
	<br>
	<?php echo form_label('Fecha de nacimiento: ','fecha_nac'); ?>
	<?php echo form_input($fecha_nac); ?>
	<br>
	<?php echo form_label('Teléfono: ','telefono'); ?>
	<?php echo form_input($telefono); ?>
	<br>
	<?php echo form_label('Domicilio: ','domicilio'); ?>
	<?php echo form_input($domicilio); ?>
	<br>
	<?php echo form_label('Provincia: ','provincia'); ?>
	<?php echo form_input($provincia); ?>
	<br>
	<?php echo form_label('Localidad: ','localidad'); ?>
	<?php echo form_input($localidad); ?>
	<br>
	<br>
	<span id="mensaje"></span>
	<br>
	
	<?php echo form_submit('Registrarme','Registrarme'); ?>
	<?php echo form_close();?>


</div>

<script type="text/javascript">

	$(document).ready(function(){
		
//---------------------CONTRASEÑAS--------------------------------------------------	
		function verifContraseñas(primeraContr){
			var segundaContr = document.getElementById('contraseña2');	
			if(primeraContr.length >16 || primeraContr.length <8){
				document.getElementById('mensaje').innerHTML = "La contraseña debe de tener entre 8 y 16 caracteres";
				$('#Registrarse').attr('disabled','disabled');
			}
			else{
				if( segundaContr.value != primeraContr){
					document.getElementById('mensaje').innerHTML = "Las contraseñas no coinciden";
					$('#Registrarse').attr('disabled','disabled');
				}else{
					document.getElementById('mensaje').innerHTML = "";
					$('#Registrarse').removeAttr('disabled');
				}
			}
		}
		function verifContraseñas2(segundaContr){
			var primeraContr = document.getElementById('contraseña1');	
			if(segundaContr.length >16 || segundaContr.length <8){
				document.getElementById('mensaje').innerHTML = "La contraseña debe de tener entre 8 y 16 caracteres";
				$('#Registrarse').attr('disabled','disabled');
			}
			else{
				if( primeraContr.value != segundaContr){
					document.getElementById('mensaje').innerHTML = "Las contraseñas no coinciden";
					$('#Registrarse').attr('disabled','disabled');
				}else{
					document.getElementById('mensaje').innerHTML = "";
					$('#Registrarse').removeAttr('disabled');
				}
			}
		}


//---------------------CORREO ELECTRÓNICO---------------------------------------------

		function verifCorreo(correo){
			
			if(primeraContr.length >16 || primeraContr.length <8){
				document.getElementById('mensaje').innerHTML = "La contraseña debe de tener entre 8 y 16 caracteres";
			}
			else{
				if( segundaContr.value != primeraContr){
					document.getElementById('mensaje').innerHTML = "Las contraseñas no coinciden";
				}else{
					document.getElementById('mensaje').innerHTML = "";
				}
			}
		}

		$.get('<?php echo base_url(); ?>index.php/Principal/buscar_usuario', function(datos){
			
				datos2=JSON.parse(datos);

				$.each(datos2,function(indice,valor){
					document.getElementById('mensaje').innerHTML = "aaa";
				});
			
		});


			
			 	var cod=$("#mensaje").val();
				if(cod!=""){
					
				}
			
	});

</script>