<?php

/*Este controlador es para lo siguiente:

	- Cargará principalmente la vista de la compra con los datos del carrito, un formulario para modificar tus datos y el apartado para introducir tu tarjeta de credito.
	- Despues del paso anterior llamará a la función "comprobar_compra", que mostrara todos los datos para verificarlos y poder echarte atras o continuar con el pago.

	- al continuar con el pago, mostrará un mensaje de exito, enviará un correo electronico.

*/



defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {
	 function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Productos_model');
		$this->load->library('Pdf');

	}


	public function index()
	{
		if(!$this->session->userdata('id')){
			redirect('Principal/no_permitido');
		}	
	//obtener categorias y estilos.
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('compra/productos_comprar');

		$this->load->view('vistas_index/footer');
	}


	public function carrito(){
		$var['producto']=$this->input->post("id_producto");
		$talla=$this->input->post("id_talla");
		$var['id_elemento']=$this->input->post("id_elemento");
		$talla_producto=$this->Productos_model->obtener_desc_talla_producto($talla);
		foreach ($talla_producto as $key) {
			$var['talla']=$key->id_talla;
			$var['desc_talla']=$key->descripcion;
		}

		$datos_producto=$this->Productos_model->obtener_precio_producto($var['producto']);
		foreach ($datos_producto as $key) {
			$var['precio']=$key->precio;
			$var['precio_ant']=$key->precio_ant;
			$var['id_tipo_producto']=$key->id_tipo_producto;
			$var['nombre_producto']=$key->nombre_producto;
			$var['color']=$key->color;
			$var['imagen']=$key->imagen;
			$var['count']=1;
		}
		echo json_encode($var);
	}





	public function comprobar_stock(){
		$productos=$this->input->post("productos");
		$viable=$this->Productos_model->comprobar_stock($productos);
		echo json_encode($viable);
	}

	public function fin_compra(){
		//$productos=$this->input->post("productos");
		//$usuario=$this->input->post("usuario");
		//$precio=$this->input->post("total"));
		//$precio=(int)$precio;
		$dataJson = file_get_contents('php://input');
		$data=json_decode($dataJson);
		$productos=$data->productos;
		$usuario=$data->usuario;
		$precio=$data->total;
		$precio=(int)$precio;		
		$fecha=getdate();
		$fecha=$fecha['mday']."-".$fecha['mon']."-".$fecha['year']." Hora: ".$fecha['hours'].":".$fecha['minutes'].":".$fecha['seconds'];
		//$this->Productos_model->generar_pedido($productos,$usuario,$precio,$fecha);
                $productos_pdf=json_decode($productos);

      for ($i=0; $i <count($productos_pdf) ; $i++) { 
		$baseFromJavascript = $productos_pdf[$i]->imagen;
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
		$filepath = $_SERVER['DOCUMENT_ROOT']."proyecto_final/images_pedido/".$productos_pdf[$i]->producto.".jpg"; // or image.jpg
		file_put_contents($filepath,$data);
        }




        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DWNPD');
        $pdf->SetTitle('Tu pedido');
        $pdf->SetSubject('');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freemono', '', 14, '', true);
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "div{width: 100%;border: 1px solid lightgrey;}";
        $html .= "</style>";
        $html .= "<h3>Pedido numero 39</h2>";
        $html .= "<h4>Hola ".$this->session->userdata("nombre")." ".$this->session->userdata("apellidos").", estos son los detalles de tu pedido</h2>";
        $html .= "<hr>";
        $html .= "<p>Datos generales:</p>";
        $html .= "<ul>";
        $html .= "<li>Fecha del pedido:".$fecha."</li>";
        $html .= "<li>Entrega prevista: 2-3 dias laborales</li>";
        $html .= "<li>Empresa encargada de la entrega: ELM 24/7</li>";
        $html .= "<li>Importe :".$precio." €</li>";
        $html .= "</ul>";

        $html .= "<hr>";
        $html .= "<p>Productos comprados:</p>";
        $html .= "<div id='productos'></div>";

        $contador_pos_imagen=100;
        for ($i=0; $i <count($productos_pdf) ; $i++) { 
        	$html .= "<div id='producto'>";
        	$html .= "<p>Nombre del producto: ".$productos_pdf[$i]->nombre_producto."</p>";
        	$html .= "<p>Talla: ".$productos_pdf[$i]->desc_talla."</p>";
        	$html .= "<p>Precio: ".$productos_pdf[$i]->precio."</p>";
        	$html .= "<p>Precio oferta: ".$productos_pdf[$i]->precio_ant."</p>";
        	$html .= "<p>Color: ".$productos_pdf[$i]->color."</p>";
        	$html .= "<p>Cantidad: ".$productos_pdf[$i]->count."</p>";
        	$html .= "<img src='".$_SERVER['DOCUMENT_ROOT']."proyecto_final/images_pedido/".$productos_pdf[$i]->producto.".jpg'>";
        	 $pdf->Image($_SERVER['DOCUMENT_ROOT']."proyecto_final/images_pedido/".$productos_pdf[$i]->producto.".jpg", 150, $contador_pos_imagen, 25, 25);
        	$html .= "</div>";
        	$contador_pos_imagen+=50;
        }

 


        

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $nombre_archivo = utf8_decode("Pedido.pdf");
		$pdf->Output($nombre_archivo, 'D');

	}

}
