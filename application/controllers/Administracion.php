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
	        'id_tipo_producto' => $this->input->post('form_tipo_producto'),
	        'nombre_producto' => $this->input->post('form_nombre_producto'),
	        'color'  => $this->input->post('form_color_producto'),
	        'id_estilo'  => $this->input->post('form_estilo_producto'),
	        'precio'  => $this->input->post('form_precio_producto').".0",
	        'precio_ant'  => '0.0',
	        'descripcion'  => $this->input->post('form_desc_producto'),
	        'imagen'  => $this->input->post('form_imagen_producto'),
	        'composicion'  => $this->input->post('form_composicion_producto'),
	        'genero'  => $this->input->post('form_genero_producto')
		);

		//$result=$this->Administracion_model->crear_producto($producto);
		//
		echo $this->input->post("form_imagen_producto");	
	}





	public function obtener_usuario(){

		$usuario=$this->Usuario_model->obtener_usuario($this->input->post('id_usuario'));
		echo json_encode($usuario);
		
	}

	public function editar_usuario(){
		
		echo json_encode($this->input->post("id_usuario"));
	}



}
