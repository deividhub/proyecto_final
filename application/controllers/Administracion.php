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
		$this->load->model('Usuario_model');
		$this->load->model('Administracion_model');
	}


	public function index()
	{
		$datos['tipos_producto']=$this->Productos_model->obtener_categorias();
		$datos['listado_completo_productos']=$this->Productos_model->obtener_productos();
		$datos['listado_completo_usuarios']=$this->Usuario_model->obtener_usuarios();
		$this->load->view('vistas_index/head');
		$this->load->view('administracion/plantilla_adm',$datos);

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
	        'genero'  => $this->input->post('genero')
		);
		
		$result=$this->Administracion_model->crear_producto($producto);
		
		//echo json_encode($this->input->post('imagen'));	
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
		$usuario = array(
	        'id_tipo_usuario' => 2,
	        'nombre' => $this->input->post('nombre'),
	        'apellidos'  => $this->input->post('apellidos'),
	        'correo'  => $this->input->post('correo'),
	        'contraseña'  => "nuevousuario",
	        'fecha_nac'  => $this->input->post('fecha_nac'),
	        'telefono'  => $this->input->post('telefono'),
	        'domicilio'  => $this->input->post('domicilio'),
	        'provincia'  => $this->input->post('provincia'),
	        'localidad'  => $this->input->post('localidad')
		);
		$this->Administracion_model->crear_usuario($usuario);
		echo json_encode($this->input->post('nombre'));
	}

	public function eliminar_usuario(){
		$this->Administracion_model->eliminar_usuario($this->input->post("id_usuario"));
	}

}
