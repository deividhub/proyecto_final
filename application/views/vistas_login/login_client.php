<?php

//-------------FORMULARIO LOGIN-------------------
	$form_login = array(
		'name' => 'form_login',
		'id' => 'FormLog'
		);
	$correo_login = array(	
		'name' => 'correo',
		'maxlength' => 30,
		'size' => 20,
		'required' => 1,
		'id' => "correo_log",
		'placeholder' => 'ejemplo@ejemplo.com'
		);
	$contraseña_login = array(	
		'name' => 'contraseña',
		'type' => 'password',
		'id' => 'contraseña_login',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'placeholder' => '********'
		);

//-------------FORMULARIO REGISTRO----------------
	$form_registro = array(
		'name' => 'form_registro',
		'id' => 'FormReg'
		);
	$correo = array(	
		'name' => 'correo',
		'id' => 'correo',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'placeholder' => 'ejemplo@ejemplo.com'
		);
	$contraseña1 = array(	
		'name' => 'contraseña1',
		'id' => 'contraseña1',
		'class' => 'txtcontraseña',
		'type' => 'password',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'placeholder' => '********'
		);
	$contraseña2 = array(	
		'name' => 'contraseña2',
		'id' => 'contraseña2',
		'class' => 'txtcontraseña',
		'type' => 'password',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'placeholder' => '********'
		);
	$nombre = array(	
		'name' => 'nombre',
		'id' => 'nombre',
		'maxlength' => 20,
		'class' => 'soloLetras',
		'size' => 20,
		'required' => 1,
		'placeholder' => 'Nombre'
		);
	$apellidos = array(	
		'name' => 'apellidos',
		'maxlength' => 20,
		'class' => 'soloLetras',
		'size' => 20,
		'required' => 1,
		'placeholder' => 'Apellidos'
		);
	$fecha_nac = array(	
		'name' => 'fecha_nac',
		'type' => 'date',
		'required' => 1
		);
	$telefono = array(	
		'name' => 'telefono',
		'maxlength' => 9,
		'class' => 'soloNumeros',
		'id' => 'telefono',
		'size' => 20,
		'required' => 1,
		'placeholder' => '666666666'
		);
	$domicilio = array(	
		'name' => 'domicilio',
		'maxlength' => 20,
		'size' => 20,
		'required' => 1,
		'placeholder' => 'C/Kalea Nº1 1ºA'
		);
	$provincia = array(	
		'name' => 'provincia',
		'required' => 1,
		'id' => 'provincia_registro'
		);
	$localidad = array(	
		'name' => 'localidad',
		'required' => 1,
		'id' => 'localidad_registro'
	);
	
	$registrarme = array(	
		'name' => 'registrarme',
		'id' => 'Registrarme',
		'value'=>'Registrarme'
	);

?>



<section id="login_client">

	<section id="juntos">
		
		<h1 id="titulo">¡Accede a nuestra tienda!</h1>

		<section id="login">

			<h1>Inicio de sesión</h1>
			
			<hr>
	
		<?php echo form_open('Principal/iniciar_sesion',$form_login);?>
	
		<?php echo form_label('Correo: ','correo'); ?>
		<?php echo form_input($correo_login); ?>
		<?php echo form_label('Contraseña: ','contraseña'); ?>
		<div id="pass_group">
			
		<?php echo form_input($contraseña_login); ?>
		<i class="material-icons" id="imgMostrarPass">visibility</i>
		</div>

		<a  href="#" class="botones">
		<button type="submit" id="btn_iniciar_sesion">Entrar</button>
		</a>
	

		<a href="#" id="recuperar_pass">Recuperar contraseña</a>
		<?php echo form_close();?>
			
			<hr>

			<p class="developed">DWNPD</p>

		</section>
		

		<section id="registro">

			<h1>Registro</h1>
			
			<hr>
<?php echo form_open('Principal/registro',$form_registro);?>

			<?php echo form_label('Correo: ','correo'); ?>
	
		<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaCorreo" class="imgAlertaPass" title="" hidden="true">
			<?php echo form_input($correo); ?>


			<?php echo form_label('Contraseña: ','contraseña1'); ?>
			<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaPass2" name="imgAlerta" class="imgAlertaPass imgAlerta" title="" hidden="true">

			<div id="pass_group">
				<?php echo form_input($contraseña1); ?>		
				<i class="material-icons" id="imgMostrarPass1">visibility</i>
			</div>
			

			<?php echo form_label('Repita su contraseña: ','contraseña2'); ?>
			<img src= https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/alert-triangle-red-512.png id="imgAlertaPass" name="imgAlertaPass2" class="imgAlertaPass imgAlerta" title="" hidden="true">

			<div id="pass_group">
			<?php echo form_input($contraseña2); ?>
				<i class="material-icons" id="imgMostrarPass2">visibility</i>
			</div>
		
			<?php echo form_label('Nombre: ','nombre'); ?>
			<?php echo form_input($nombre); ?>
			
			<?php echo form_label('Apellidos: ','apellidos'); ?>
			<?php echo form_input($apellidos); ?>
		
			<?php echo form_label('Fecha de nacimiento: ','fecha_nac'); ?>
			<?php echo form_input($fecha_nac); ?>
			
			<?php echo form_label('Teléfono: ','telefono'); ?>
			<?php echo form_input($telefono); ?>
			
			<?php echo form_label('Domicilio: ','domicilio'); ?>
			<?php echo form_input($domicilio); ?>
			
			<?php echo form_label('Provincia: ','provincia'); ?>
			<?php echo form_dropdown($provincia); ?>
			
			<?php echo form_label('Localidad: ','localidad'); ?>
			<?php echo form_dropdown($localidad); ?>
	

		<span id="mensajeCorreo"></span>
		<span id="mensaje"></span>
		<br>

		<a  href="#" class="botones">
			<button type="submit" id="Registrarme">Registrarme</button>
		</a>

		<?php echo form_close();?>
			
			<hr>

			<p class="developed">DWNPD</p>

		</section>

	</section>

</section>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script type="text/javascript">

	$(document).ready(function(){

		//------DESPLEGAR REGISTRO------------
		$("#mostrarRegistro").click(function(){
			if($("#divReg").is(":visible")){
				$("#divReg").slideUp(1500)
			}
			else{
				$("#divReg").fadeToggle(2000);
			}
		});

		
		//--ZONA DE PRUEBAS----ZONA DE PRUEBAS----ZONA DE PRUEBAS----ZONA DE PRUEBAS----ZONA DE PRUEBAS--
		$('#correo').on('keyup', function(e){
			var correo = document.getElementById('correo').value;
			//alert(correo);
			$.get('<?php echo base_url(); ?>index.php/Principal/buscar_usuario',{correo:correo}, function(datos){
				
				datos2=JSON.parse(datos);

				$.each(datos2,function(indice,valor){
					
				});	
			});
		});
		//--ZONA DE PRUEBAS----ZONA DE PRUEBAS----ZONA DE PRUEBAS----ZONA DE PRUEBAS----ZONA DE PRUEBAS--
	


        //------CONTRASEÑAS------------------	
		$("#Registrarme").click(function(e){

			var primeraContr = document.getElementById('contraseña1');	
			var segundaContr = document.getElementById('contraseña2');
			
			var email = document.getElementById('correo').value;
			var emailReg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			
			if(emailReg.test(email)==false){
				
				$("#correo").css("border", "solid 1px red");
				document.getElementById('imgAlertaCorreo').hidden=false;
				document.getElementById('imgAlertaCorreo').title = "Correo no válido";
				swal("Comprueba los datos")
			}
			else{
				document.getElementById('imgAlertaCorreo').hidden=true;
			}

			if((primeraContr.value.length >16 || primeraContr.value.length <8)||(segundaContr.value.length >16 || segundaContr.value.length <8)){
				e.preventDefault();
				document.getElementById('imgAlertaPass').title = "La contraseña debe de tener entre 8 y 16 caracteres";
				document.getElementById('imgAlertaPass2').title = "La contraseña debe de tener entre 8 y 16 caracteres";
				$(".imgAlertaPass").css("display", "inline");
				$(".txtcontraseña").css("border", "solid 1px red");
				swal("Comprueba los datos")

			}
			else{
				if( segundaContr.value != primeraContr.value){
					e.preventDefault();
					document.getElementById('imgAlertaPass').title = "Las contraseñas no coinciden";
					document.getElementById('imgAlertaPass2').title = "Las contraseñas no coinciden";
					$(".imgAlertaPass").css("display", "inline");
					$(".txtcontraseña").css("border", "solid 1px red");
					swal("Comprueba los datos")

				}else{

					//-------AQUI HACER FUNCIÓN--------//

				}
			}
		});

		
		//------------MOSTRAR CONTRASEÑA-----------------
		$("#imgMostrarPass").mouseup(function(){
			$("#contraseña_login").attr('type', 'password');
		});
		$("#imgMostrarPass").mousedown(function(){
			$("#contraseña_login").removeAttr('type');
		});


		$("#imgMostrarPass1").mouseup(function(){
			$("#contraseña1").attr('type', 'password');
		});
		$("#imgMostrarPass1").mousedown(function(){
			$("#contraseña1").removeAttr('type');
		});	


		$("#imgMostrarPass2").mouseup(function(){
			$("#contraseña2").attr('type', 'password');
		});
		$("#imgMostrarPass2").mousedown(function(){
			$("#contraseña2").removeAttr('type');
		});

		//-----------FOCUS/BLUR INPUTS----------
		$("input").focus(function(){
			$(this).addClass("sombraInputs");
		});
		$("input").blur(function(){
			$(this).removeClass("sombraInputs");
		});

		//---------CAMPOS SOLO LETRAS/NUMEROS-----------//
		$('.soloNumeros').on('input', function(e){
			this.value = this.value.replace(/[^0-9]/g,'');
		});
		$('.soloLetras').on('keyup', function(e){
    	var codigo = e.which || e.keyCode;
    	if(codigo!=32){
    					this.value = this.value.replace(/[^A-Za-z]/g,' ');

    	}

		});
		

	
});				

			
	

</script>