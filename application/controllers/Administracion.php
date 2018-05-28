<?php

/*Este controlador es para lo siguiente:

	- 

	- 

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends CI_Controller {
	 function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Productos_model');
		$this->load->model('Principal_model');
		$this->load->model('Usuario_model');
		$this->load->library('Email');
		$this->load->model('Administracion_model');
	}


	public function index()
	{
		if($this->session->admin!=true){
			redirect('Administracion/iniciar_sesion');
		}
		$datos['tipos_producto']=$this->Productos_model->obtener_categorias();
		$datos['listado_completo_productos']=$this->Productos_model->obtener_productos_adm();
		$datos['listado_completo_usuarios']=$this->Usuario_model->obtener_usuarios();
		$datos['listado_completo_comentarios']=$this->Administracion_model->obtener_comentarios();
		$datos['listado_completo_pedidos']=$this->Productos_model->obtener_pedidos();
		$datos['estados_pedido']=$this->Productos_model->obtener_estados();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		//$datos['pedido_producto']=$this->Productos_model->obtener_estados();
		//$datos['talla']=$this->Productos_model->obtener_estados();
		$datos['stock_productos']=$this->Productos_model->obtener_stock_total();
		$datos['tipo_producto']=$this->Productos_model->obtener_categorias();
		$this->load->view('vistas_index/head');
		$this->load->view('administracion/plantilla_adm',$datos);

	}

	public function iniciar_sesion()
	{
		$this->load->view('vistas_index/head');
		$this->load->view('vistas_login/login_admin');


	}

	public function logout(){
		$this->session->unset_userdata('admin');
		redirect('Administracion');
	}
	public function login()
	{

		$usuario=$this->Principal_model->obtener_usuario_admin($this->input->post("correo"),$this->input->post("pass"));
		if ($usuario!='ERROR'){
				foreach ($usuario as $usuario2) {
					if ($usuario2->id_tipo_usuario==2) {
						echo json_encode(1);
					}
					else{		
						$this->session->set_userdata("admin",true); 
						echo json_encode($usuario);	
					}
				}
			}
			else{
				echo json_encode(1);
			}
	}
	public function estilos(){
		$estilos=$this->Productos_model->obtener_estilo_tipos($this->input->post("id_tipo_producto"));

		echo json_encode($estilos);
		
	}

	public function crear_producto(){
		$producto = array(
	        'id_tipo_producto' => $this->input->post('id_tipo_producto'),
	        'nombre_producto' => $this->input->post('nombre_producto'),
	        'color'  => $this->input->post('color'),
	        'id_estilo'  => $this->input->post('id_estilo'),
	        'precio'  => $this->input->post('precio').".0",
	        'precio_ant'  => '0.0',
	        'descripcion'  => $this->input->post('descripcion'),
	        'imagen'  => $this->input->post('imagen'),
	        'composicion'  => $this->input->post('composicion'),
	        'genero'  => $this->input->post('genero'),
	        'estado'  => 'ACTIVO'
		);
		
		$result=$this->Administracion_model->crear_producto($producto);
		
		//echo json_encode($this->input->post('imagen'));	
	}

	public function obtener_producto(){

		$producto=$this->Productos_model->obtener_producto($this->input->post('id_producto'));
		echo json_encode($producto);
		
	}

	public function editar_producto(){


		if ($this->input->post('imagen')==null) {
			$producto = array(
		        'id_tipo_producto' => $this->input->post('id_tipo_producto'),
		        'nombre_producto'  => $this->input->post('nombre_producto'),
		        'color'  => $this->input->post('color'),
		        'id_estilo'  => $this->input->post('id_estilo'),
		        'precio'  => $this->input->post('precio'),
		        'precio_ant'  => $this->input->post('precio_oferta'),
		        'descripcion'  => $this->input->post('descripcion'),
		        'composicion'  => $this->input->post('composicion'),
		        'genero'  => $this->input->post('genero'),
			);
		}
		else{
			$producto = array(
		        'id_tipo_producto' => $this->input->post('id_tipo_producto'),
		        'nombre_producto'  => $this->input->post('nombre_producto'),
		        'color'  => $this->input->post('color'),
		        'id_estilo'  => $this->input->post('id_estilo'),
		        'precio'  => $this->input->post('precio'),
		        'precio_ant'  => $this->input->post('precio_oferta'),
		        'descripcion'  => $this->input->post('descripcion'),
		        'imagen'  => $this->input->post('imagen'),
		        'composicion'  => $this->input->post('composicion'),
		        'genero'  => $this->input->post('genero'),
			);
		}

		$id=$this->input->post('id_producto');
		$this->Administracion_model->editar_producto($producto,$id);
		echo json_encode($this->input->post('id_producto'));
		
	}


	public function eliminar_producto(){
		$this->Administracion_model->eliminar_producto($this->input->post("id_producto"));
	}


	public function obtener_usuario(){

		$usuario=$this->Usuario_model->obtener_usuario($this->input->post('id_usuario'));
		echo json_encode($usuario);
		
	}

	public function editar_usuario(){
		$usuario = array(
	        'nombre' => $this->input->post('nombre'),
	        'apellidos'  => $this->input->post('apellidos'),
	        'correo'  => $this->input->post('correo'),
	        'fecha_nac'  => $this->input->post('fecha_nac'),
	        'telefono'  => $this->input->post('telefono'),
	        'domicilio'  => $this->input->post('domicilio'),
	        'provincia'  => $this->input->post('provincia'),
	        'localidad'  => $this->input->post('localidad')
		);
		$id=$this->input->post('id_usuario');
		$this->Administracion_model->editar_usuario($usuario,$id);
		echo json_encode($this->input->post('nombre'));
	}

	public function crear_usuario(){
	    $mensaje="";
		$mensaje .="<!DOCTYPE html>
				<html>
				<head>
					<meta charset='utf-8'>
					<title></title>
					<style>
				ul{
					list-style: none;
				}

				footer{
					width: 100%;
					background: black;
					color: white;
					display: flex;
				}
				*{
					margin: 0;
					padding: 0;
				}
				
				header{
					border-bottom: 1px solid lightgrey;
					font-size: 24px;
					background: black;
					color: white;
				}


				.titulo{
					font-size: 24px;
					font-weight: bold;
				}



				footer ul{
					width: 100%;
					text-align: center;
				}

				.logo {
					color: #c1b497;
					font-size: 34px!important;
					text-align: center;
					text-decoration: underline overline;
				}
			    #download_image{
					width: 100px;
					cursor: pointer;

				}
				.saludo{
					font-size: 20px;
					text-align: center;
					width: 90%;
					margin: 20px auto 20px auto;
				}</style>
				</head>
				<body>
					<header id='header' class=''>
						<p class='logo'>DWNPD-SHOP</p>
					</header><!-- /header -->";


			$mensaje .="<section>
		<p class='saludo'>Hola ".$this->input->post('nombre').", <br>Te hemos creado una cuenta en nuestra tienda para que te unas  a las muchas personas que ya compran en nuestra web</p>";
			
			$mensaje .="<p class='saludo'>Tus datos de acceso a nuestra tienda son los siguiente: <br>
		Usuario: ".$this->input->post('correo')."
		Contraseña: nuevousuario <br><br>
		¡RECUERDA MODIFICAR ESTA CONTRASEÑA AL ACCEDER!

		</p>
	</section>
	<footer>
		<ul>
		    <li>¡Traemos nueva App!</li>
		    <li>¡Descargala aqui abajo!</li>
		    <li><a href='https://devdavid.000webhostapp.com/proyecto_final/downloads/DWNPD_android_app.zip'><img src='https://devdavid.000webhostapp.com/proyecto_final/img/icon.png' id='download_image'></a></li>
		</ul>
		<ul>
		    <li>&copy DWNPD-SHOP 2018</li>
		    <li class='logo'>DWNPD</li>
		</ul>
		
	</footer>
</body>
</html>";
		   $confing =array(
		    'protocol'=>'smtp',
		    'smtp_host'=>"smtp.gmail.com",
		    'smtp_port'=>'465',
		    'smtp_user'=>"dwnpdshop@gmail.com",
		    'smtp_pass'=>"dwnpd2018",
		    'smtp_crypto'=>'ssl',              
		    'mailtype'=>'html', 
		     'validate' => true
		 
		    );
		    $this->email->initialize($confing);
		    $this->email->set_newline("\r\n");
		    $this->email->from('dwnpdshop@gmail.com');
		    $this->email->to($this->input->post('correo'));
		    $this->email->subject('Bienvenido a DWNPD-SHOP');
		    $this->email->message($mensaje);
		    $this->email->send();
		$usuario = array(
	        'id_tipo_usuario' => 2,
	        'nombre' => $this->input->post('nombre'),
	        'apellidos'  => $this->input->post('apellidos'),
	        'correo'  => $this->input->post('correo'),
	        'contraseña'  => md5("nuevousuario"),
	        'fecha_nac'  => $this->input->post('fecha_nac'),
	        'telefono'  => $this->input->post('telefono'),
	        'domicilio'  => $this->input->post('domicilio'),
	        'provincia'  => $this->input->post('provincia'),
	        'localidad'  => $this->input->post('localidad'),
	        'estado'  => 'ACTIVO'
		);
		$this->Administracion_model->crear_usuario($usuario);
		echo json_encode($this->input->post('nombre'));
	}

	public function eliminar_usuario(){
		$this->Administracion_model->eliminar_usuario($this->input->post("id_usuario"));
	}



	public function eliminar_comentario(){
		$this->Administracion_model->eliminar_comentario($this->input->post("id_comentario"));
	}


	public function actualizar_pedido(){
		$a=$this->Administracion_model->actualizar_pedido($this->input->post("pedido"),$this->input->post("state"));
		$estado=$this->Administracion_model->state_adm($this->input->post("state"));
		$correo=$this->Administracion_model->user_adm($this->input->post("pedido"));
			    
			    
			    $mensaje="";
		$mensaje .="<!DOCTYPE html>
				<html>
				<head>
					<meta charset='utf-8'>
					<title></title>
					<style>
				ul{
					list-style: none;
				}

				footer{
					width: 100%;
					background: black;
					color: white;
					display: flex;
				}
				*{
					margin: 0;
					padding: 0;
				}
				
				header{
					border-bottom: 1px solid lightgrey;
					font-size: 24px;
					background: black;
					color: white;
				}


				.titulo{
					font-size: 24px;
					font-weight: bold;
				}



				footer ul{
					width: 100%;
					text-align: center;
				}

				.logo {
					color: #c1b497;
					font-size: 34px!important;
					text-align: center;
					text-decoration: underline overline;
				}
			    #download_image{
					width: 100px;
					cursor: pointer;

				}
				.saludo{
					font-size: 20px;
					text-align: center;
					width: 90%;
					margin: 20px auto 20px auto;
				}</style>
				</head>
				<body>
					<header id='header' class=''>
						<p class='logo'>DWNPD-SHOP</p>
					</header><!-- /header -->";


			$mensaje .="<section>
		<p class='saludo'>Hola, se ha actualizado el estado del pedido asociado al correo electronico $correo</p>";
			
			$mensaje .="<p class='saludo'>Su nuevo estado es $estado

		</p>
	</section>
	<footer>
		<ul>
		    <li>¡Traemos nueva App!</li>
		    <li>¡Descargala aqui abajo!</li>
		    <li><a href='https://devdavid.000webhostapp.com/proyecto_final/downloads/DWNPD_android_app.zip'><img src='https://devdavid.000webhostapp.com/proyecto_final/img/icon.png' id='download_image'></a></li>
		</ul>
		<ul>
		    <li>&copy DWNPD-SHOP 2018</li>
		    <li class='logo'>DWNPD</li>
		</ul>
		
	</footer>
</body>
</html>";
		   $confing =array(
		    'protocol'=>'smtp',
		    'smtp_host'=>"smtp.gmail.com",
		    'smtp_port'=>'465',
		    'smtp_user'=>"dwnpdshop@gmail.com",
		    'smtp_pass'=>"dwnpd2018",
		    'smtp_crypto'=>'ssl',              
		    'mailtype'=>'html', 
		     'validate' => true
		 
		    );
		    $this->email->initialize($confing);
		    $this->email->set_newline("\r\n");
		    $this->email->from('dwnpdshop@gmail.com');
		    $this->email->to($correo);
		    $this->email->subject('Actualización de tu pedido');
		    $this->email->message($mensaje);
		    $this->email->send();
	}

	public function actualizar_stock(){
		$this->Administracion_model->actualizar_stock($this->input->post("id_talla_producto"));
	}




	public function recuperar_pass(){
		$result=$this->Administracion_model->recuperar_pass($this->input->post("id_usuario"));
		echo json_encode($result);
	}
}
