<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion_model extends CI_Model {

        public function crear_producto($producto)
        {		
        		// añadir el producto

        		$this->db->insert('producto',$producto);
        		//return $producto;
        		// cojer el id que se ha metido de ese producto
                $max = "SELECT MAX(id_producto) maximo FROM producto";
                $maxQuery=$this->db->query($max);
                foreach ($maxQuery->result() as $key) {
                	$maximo=$key->maximo;
                }

               // // cojer las tallas de ese tipo de producto
                $tallas = "SELECT * from talla WHERE id_tipo_producto='".$producto['id_tipo_producto']."'";
                $tallasQuery=$this->db->query($tallas);

                foreach ($tallasQuery->result() as $key) {
	                // ahora rellenar el stock
	         		$añadirStock="INSERT INTO talla_producto VALUES(NULL,".$key->id_talla.",".$maximo.",15)";
	                $this->db->query($añadirStock);
                }
        }



        public function editar_producto($array_producto,$id){
          $this->db->where('id_producto', $id);
          $this->db->update('producto', $array_producto);

        }

         public function eliminar_producto($id){
            $sql = "UPDATE producto SET estado='ELIMINADO' WHERE id_producto=$id";
            $query=$this->db->query($sql);
          }
        public function editar_usuario($array_usuario,$id){

          $this->db->where('id_usuario', $id);
          $this->db->update('usuario', $array_usuario);

        }

       public function crear_usuario($array_usuario){

          $this->db->insert('usuario', $array_usuario);

        }
        public function eliminar_usuario($id){
          $sql = "UPDATE usuario SET estado='ELIMINADO' WHERE id_usuario=$id";
          $query=$this->db->query($sql);

        }
        public function obtener_comentarios(){
            $sql = "SELECT * FROM comentario";
            $query=$this->db->query($sql);
            return $query->result();
        }

        public function eliminar_comentario($id){
            $this->db->where('id_comentario', $id);
            $this->db->delete('comentario');
        }

        public function actualizar_pedido($id,$state){
          $sql = "UPDATE pedido SET id_estado=$state WHERE id_pedido=$id";
          $query=$this->db->query($sql);
        }    

        public function actualizar_stock($id){
          $sql = "UPDATE talla_producto SET stock=15 WHERE id_talla_producto=$id";
          $query=$this->db->query($sql);
        }


       public function recuperar_pass($id){
            $sql = "SELECT * FROM usuario WHERE id_usuario=$id";
            $query=$this->db->query($sql);
            foreach($query->result() as $key){
                $correo=$key->correo;
                $nombre=$key->nombre;
            }
            if($query->num_rows()>0){
                $pass=getdate();
                $pass=$pass['0'];
                $pass=md5($pass);
                $pass=substr($pass,-6);
                                		$mensaje="";
		$mensaje .="
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title></title>
	<style>
#cajaExterior{
	border: 1px outset black;
	border-radius: 10px;
	padding: 3%;
	max-width: 620px;
	margin: 20px auto;


	-webkit-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);
	box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);
}
#caja1CC{
}
#caja2CC{
	margin-top: 2%;
	width: 100%;
	text-align: center;
}
#caja3CC{
	margin-top: 3%;
	border:2px yellow outset;
	border-radius: 10px;
	padding: 2%;
	padding-top: 0px;
	background-color: rgba(255,211,56,0.3);
}
#caja4CC{
	width: 100%;
	text-align: right;
	margin-top: 4%;
}
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
				}

.imgCC{
	width: 20px;
}

	</style>
</head>
<body>
	<header id='header'>
		<p class='logo'>DWNPD-SHOP</p>
	</header><!-- /header -->




<div id='cajaExterior'>	
	<div id='caja1CC'>
		<h2>¡Cambio de contraseña completado!   <img class='imgCC' src='https://i.pinimg.com/originals/86/03/f3/8603f3e9fd0cb78ccdf590bfc0cca902.png'></h2>
		
		Buenas ".$nombre." desde administración hemos modificado tu contraseña,
		<br><br>
		nos alegra que sigas formando parte de la comunidad de usuarios que ha optado por usar nuestros servicios, y confiar plenamente en nosotros al crearte una cuenta en nuestra página web.
	</div>
	<div id='caja2CC'><b>Tu nueva contraseña es:</b> ".$pass."</div>
	<div id='caja3CC'>
		<h3>¡Y recuerda!</h3>
		<img class='imgCC' src='https://cdn.pixabay.com/photo/2013/07/12/12/40/exclamation-146074_960_720.png'>  Desde DWNPD te recomendamos <b>que borres este mensaje</b> para mayor seguridad.  <img class='imgCC' src='https://cdn.pixabay.com/photo/2013/07/12/12/40/exclamation-146074_960_720.png'>
	</div>
	<div id='caja4CC'>Atentamente, el quipo de DWNPD.</div>
</div>



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
		    $this->email->subject('Bienvenido a DWNPD-SHOP');
		    $this->email->message($mensaje);
		    $this->email->send();
                $sql2 = "UPDATE usuario SET contraseña='".md5($pass)."' WHERE id_usuario=$id";
                $this->db->query($sql2);
                return $pass;

            }
            else{
                return "ERROR";
            }
        }

        public function user_adm($pedido){
        $sql = "SELECT * FROM usuario u, pedido p WHERE u.id_usuario=p.id_usuario AND id_pedido=$pedido";
          $query=$this->db->query($sql);
          foreach($query->result() as $key){
              return $key->correo;
          }
        }
        
        public function state_adm($estado){
        $sql = "SELECT * FROM estado_pedido WHERE id_estado=$estado";
          $query=$this->db->query($sql);
          foreach($query->result() as $key){
              return $key->desc_estado;
          }
        }


}


 ?>
