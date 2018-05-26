<?php

/*Este controlador es para lo siguiente:

	- Cargará principalmente la pagina principal.
	- Al darle a iniciar sesion/registro se ejecutará la funcion "formulario_sesion_registro", la cual carga la vista de dos formularios para registrar o iniciar sesion.

	- al rellenar el formulario de iniciar sesion y darle al boton se ejecutará la función "iniciar_sesion" y en caso de darle a registrar la de "registrar".

*/



defined('BASEPATH') OR exit('No direct script access allowed');

// sesion y database ya estan puestos en autoload!!!!!
class Principal extends CI_Controller {
	 function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Principal_model');
		$this->load->model('Productos_model');
		$this->load->library('email');
		$this->load->helper('email');

	}


	public function index()
	{


   /*$confing =array(
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
    $this->email->to("david.izkara@gmail.com");
    $this->email->subject('You Subject');
    $this->email->message("hoolllaaaa");
    $this->email->send();*/
		
    $this->session->unset_userdata('genero');

		//obtener categorias y estilos.
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$datos['productos_rdm']=$this->Productos_model->obtener_productos_rdm();

		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('vistas_index/principal',$datos);
		$this->load->view('vistas_index/footer');


	}


	public function login_registro(){
	// devuelve 2 tipos de datos: redireccion al logueado o error al iniciar sesion.
		// utilizar md5
		//obtener categorias y estilos.
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$datos['productos_rdm']=$this->Productos_model->obtener_productos_rdm();

		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('vistas_login/login_client');
		$this->load->view('vistas_index/footer');

	}

	public function iniciar_sesion(){
			// devuelve 2 tipos de datos: redireccion al logueado o error al iniciar sesion.
		
			$correo = $this->input->post('correo');
			$contraseña = $this->input->post('pass');
			$usuario = $this->Principal_model->obtener_usuario($correo,$contraseña);

			if ($usuario!='ERROR'){
				foreach ($usuario as $usuario2) {
					if ($usuario2->id_tipo_usuario==1) {
						echo json_encode(1);
					}
					else{
						$usuario_data = array(
		               		'nombre' => $usuario2->nombre,
		               		'correo' => $usuario2->correo,
		               		'id' => $usuario2->id_usuario,
		               		'apellidos' => $usuario2->apellidos,
		               		'fecha' => $usuario2->fecha_nac,
		               		'telefono' => $usuario2->telefono,
		               		'domicilio' => $usuario2->domicilio,
		               		'provincia' => $usuario2->provincia,
		               		'localidad' => $usuario2->localidad
		            	);		
						$this->session->set_userdata($usuario_data); 
						echo json_encode($usuario);	
					}



				}
			}
			else{
				echo json_encode(1);
			}
		}


	public function registro(){
		$datos['correo'] = $this->input->post('correo');
		$contraseña= $this->input->post('contraseña1');
		$datos['contraseña'] = md5($contraseña);
		$datos['nombre'] = $this->input->post('nombre');
		$datos['apellidos'] = $this->input->post('apellidos');
		$datos['fecha_nac'] = $this->input->post('fecha_nac');
		$datos['telefono'] = $this->input->post('telefono');
		$datos['domicilio'] = $this->input->post('domicilio');
		$datos['provincia'] = $this->input->post('provincia');
		$datos['localidad'] = $this->input->post('localidad');

		/*
		ini_set( 'sendmail_from', "myself@my.com" ); 
		ini_set( 'SMTP', "mail.bigpond.com" );  
		ini_set( 'smtp_port', 25 );


		$cabeceras = 'From: webmaster@example.com' . "\r\n" .
		'Reply-To: webmaster@example.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();


		$mensaje= " Nos alegra saber que te has unido a las muchas personas que hoy en día realizan sus compras a traves de nuestra nueva web.";

		$bool = mail("administracion@dwnpd.org","Mensaje registro","pedroetxebarribhi@gmail.com",$cabeceras);
		if($bool){
			echo "Mensaje enviado";
		}else{
			echo "Mensaje no enviado";
		}*/

		$this->Principal_model->registrarse($datos);
		$this->session->set_userdata("registrado",true); 
		redirect('Principal/login_registro');
	}

	public function registrado(){
		if($this->session->userdata("registrado")){
			echo json_encode(true);
			$this->session->unset_userdata("registrado");

		}
		else{
			echo json_encode(false);
		}
	}





	public function perfil_usuario(){
		if(!$this->session->userdata('id')){
			redirect('Principal/no_permitido');
		}	
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('administracion/plantilla_client');
		$this->load->view('vistas_index/footer');
	}

	public function contacto(){		
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('contacto/contacto');
		$this->load->view('vistas_index/footer');
}
	public function recuperar_pass(){
		$result=$this->Principal_model->recuperar_pass($this->input->post("correo"));
		if($result=="ERROR"){
			echo json_encode(1);
		}
		else{
			echo json_encode($result);
		}
	}

	public function cerrar_sesion(){
		$array_items = array('nombre', 'correo','id','apellidos','fecha','telefono','domicilio','provincia','localidad');
		$this->session->unset_userdata($array_items);
		echo json_encode($this->session->userdata());
	}

	public function comprobar_login(){
		if($this->session->userdata('id')){
			echo json_encode(true);
		}
		else{
			echo json_encode(false);

		}
	}


	public function no_permitido(){
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('index.html');
		$this->load->view('vistas_index/footer');		
	}



	public function cargar_provincias(){
		echo json_encode($this->Principal_model->cargar_provincias());
	}	
	public function cargar_localidades(){
		$id_provincia=$this->input->post("provincia");
		
		echo json_encode($this->Principal_model->cargar_localidades($id_provincia));
	}


}