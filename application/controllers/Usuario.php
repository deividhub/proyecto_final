<?php

/*Este controlador es para lo siguiente:

	- Cambiar datos del usuario iniciado
	- obtener sus pedidos, favoritos etc. 

*/

defined('BASEPATH') OR exit('No direct script access allowed');


class Usuario extends CI_Controller {


	function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Usuario_model');
		$this->load->model('Comentario_model');
		$this->load->model('Administracion_model');
	}

	// solo llamar a la funcion
	public function pedidos(){
		$pedidos = $this->Usuario_model->obtener_pedidos_usuario();
		echo json_encode($pedidos);

	}

	// enviar el id de un pedido
	public function productos_del_pedido(){
		$id_pedido = $this->input->post("id_pedido");
		$productos = $this->Usuario_model->obtener_productos_pedido_usuario($id_pedido);
		echo json_encode($productos);
	}

	// solo llamar a la funcion
	public function favoritos(){
		$favoritos = $this->Usuario_model->obtener_favoritos_usuario();
		echo json_encode($favoritos);
	}

	// solo llamar a la funcion
	public function obtener_comentarios(){
		$comentarios = $this->Comentario_model->obtener_comentarios_usuario($this->session->userdata('id'));
		echo json_encode($comentarios);
		
	}

	// funcion para la contraseña
	public function recuperar_contrasena(){
		$pass = $this->input->post("pass");
		$this->Usuario_model->recuperar_contrasena(md5($pass));
		echo json_encode("¡Contraseña modificada con exito!");
	}

	public function guardar_datos(){
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

}
