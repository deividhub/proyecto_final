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
		$this->load->library('Email');

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
		$this->Productos_model->generar_pedido($productos,$usuario,$precio,$fecha);
        $productos_pdf=json_decode($productos);
        $numero_pedido=$this->Productos_model->count_pedidos();
$configGmail = array(
		 'protocol' => 'smtp',
		 'smtp_host' => 'ssl://smtp.gmail.com',
		 'smtp_port' => 465,
		 'smtp_user' => 'dwnpdshop@gmail.com',
		 'smtp_pass' => 'dwnpd2018',
		 'mailtype' => 'html',
		 'charset' => 'utf-8',
		 'newline' => "\r\n"
		 );    
		 $mensaje ="";
		 $mensaje .='<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
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

#download_image{
	width: 100px;
	cursor: pointer;
	animation: resplandor 2s infinite;
	filter: drop-shadow(5px 5px 250px lightgrey);

}
@keyframes resplandor{
	to {
filter: drop-shadow(5px 5px 10px lightgrey);
	}
}


#imagen_details{
display: flex;
}
#imagen_details img{
width: 100px;
}

#imagen_details ul{
margin:20px 0;
width: 100%;
border-bottom: 1px solid lightgrey;
}
#final{
	text-align: right;
	font-weight: bold;
	font-size: 20px;
}
.titulo{
	font-size: 24px;
	font-weight: bold;
}

.articulo{
	width: 80%;
	margin:  20px auto 20px auto;
	box-shadow: 2px 2px 2px 2px lightgrey;
	border: 1px solid #c1b497;
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


.saludo{
	font-size: 20px;
	text-align: center;
	margin-top: 20px;
}

#envio_details li::before{
content: " -";
}</style>
</head>
<body>
	<header id="header" class="">
		<p class="logo">DWNPD-SHOP</p>
	</header><!-- /header -->
	<section>
		<p class="saludo">Hola '.$this->session->userdata('nombre').' estos son los detalles de tu pedido</p>
		<article id="productos" class="articulo">
			<ul>
			    <li class="titulo">Productos comprados</li>
			</ul>';
			

			
			
			
	        for ($i=0; $i <count($productos_pdf) ; $i++) { 
            $baseFromJavascript = $productos_pdf[$i]->imagen;
		    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
	        $filepath = $_SERVER['DOCUMENT_ROOT']."proyecto_final/images_pedido/".$productos_pdf[$i]->producto.".jpg";
        	file_put_contents($filepath,$data);
        	if($productos_pdf[$i]->precio_ant!=0){
        		$precio_pro=$productos_pdf[$i]->precio_ant;
        	}
        	else{
        		$precio_pro=$productos_pdf[$i]->precio;
        	}
			$mensaje .='<article id="imagen_details">
				<ul>
				    <img src="https://devdavid.000webhostapp.com/proyecto_final/images_pedido/'.$productos_pdf[$i]->producto.'.jpg">
				</ul>	
				<ul>
				    <li>'.$productos_pdf[$i]->nombre_producto.'</li>
				    <li>Color: '.$productos_pdf[$i]->color.'</li>
				    <li>Talla: '.$productos_pdf[$i]->desc_talla.'</li>
				    <li>Precio '.$precio_pro.' €</li>
				</ul>
			</article>';
			}
		$mensaje.='
			<article id="final">
				<ul>
				    <li>Precio final del pedido 25€</li>
				</ul>
			</article>

		</article>

		<article id="envio" class="articulo">
			<ul>
			    <li class="titulo">Detalles del envio</li>
			</ul>
			<article id="envio_details">
				<ul>
				    <li>El envio sera realizado por ELM 24/7</li>
				    <li>Desde tu perfil podrás acceder a los detalles del envio.</li>
				    <li>La empresa encargada del transporte te enviará un email del progreso de tu pedido.</li>
				    <li>Si el pedido no llega en 2-3 días laborales contacta con elmenvios@gmail.com.</li>
				</ul>
			</article>

		</article>
	</section>
	<footer>
		<ul>
		    <li>¡Traemos nueva App!</li>
		    <li>¡Descargala aqui abajo!</li>
		    <li><img src="icon.png" id="download_image"></li>
		</ul>
		<ul>
		    <li>&copy DWNPD-SHOP 2018</li>
		    <li class="logo">DWNPD</li>
		</ul>
		
	</footer>
</body>
</html>';
		 //cargamos la configuración para enviar con gmail
		 $this->email->initialize($configGmail);
		 
		 $this->email->from('dwnpdshop@gmail.com');
		 $this->email->to($this->session->userdata("correo"));
		 $this->email->subject('Pedido en DWNPD');
		 $this->email->message($mensaje);
		 $this->email->send();

      /*for ($i=0; $i <count($productos_pdf) ; $i++) { 
		$baseFromJavascript = $productos_pdf[$i]->imagen;
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
		$filepath = $_SERVER['DOCUMENT_ROOT']."proyecto_final/images_pedido/".$productos_pdf[$i]->producto.".jpg"; // or image.jpg
		file_put_contents($filepath,$data);
        }*/




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
        $html .= "div{width: 100%;border: 1px solid lightgrey;margin:30px 0;}";
        $html .= "</style>";
        $html .= "<h3>Pedido numero $numero_pedido</h2>";
        $html .= "<h4>Hola ".$this->session->userdata("nombre")." ".$this->session->userdata("apellidos").", estos son los detalles de tu pedido</h2>";
        $html .= "<hr>";
        $html .= "<p>Datos generales:</p>";
        $html .= "<p>Fecha del pedido:".$fecha."</p>";
        $html .= "<p>Entrega prevista: 2-3 dias laborales</p>";
        $html .= "<p>Empresa encargada de la entrega: ELM 24/7</p>";
        $html .= "<p>Importe :".$precio." €</p>";

        $html .= "<hr>";
        $html .= "<p>Productos comprados:</p>";
        $html .= "<div id='productos'></div>";

        //$contador_pos_imagen=200;
        for ($i=0; $i <count($productos_pdf) ; $i++) { 
        	$html .= "<div id='producto'>";
        	$html .= "<p>Nombre del producto: ".$productos_pdf[$i]->nombre_producto."</p>";
        	$html .= "<p>Talla: ".$productos_pdf[$i]->desc_talla."</p>";
        	$html .= "<p>Precio: ".$productos_pdf[$i]->precio."</p>";
        	$html .= "<p>Precio oferta: ".$productos_pdf[$i]->precio_ant."</p>";
        	$html .= "<p>Color: ".$productos_pdf[$i]->color."</p>";
        	$html .= "<p>Cantidad: ".$productos_pdf[$i]->count."</p>";
        	//$html .= $pdf->Image($_SERVER['DOCUMENT_ROOT']."proyecto_final/images_pedido/".$productos_pdf[$i]->producto.".jpg","" , "", 25, 25);
        	$html .= "</div>";
        	//$contador_pos_imagen+=50;
        }

        $html .= "<div id='productos'>Detalles del envio";
        $html .= "<p>El pedido aún no ha sido empaquetado, según vaya avanzando el proceso te mandaremos un correo electronico</p>";
        $html .= "</div>";


        $html .= "<footer>";
        $html .= "<p>¡Gracias por confiar en nosotros!</p>";
        $html .= "</footer>";
 


        

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $nombre_archivo = utf8_decode("Pedido.pdf");
		$pdf->Output($nombre_archivo, 'D');











	}

}
