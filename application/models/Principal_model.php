<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_model extends CI_Model {

      public function obtener_usuario($correo,$pass){
        $sql="SELECT id_usuario,id_tipo_usuario, correo, contraseña, nombre, apellidos, fecha_nac, telefono, domicilio, u.provincia provincia, u.localidad localidad, estado, p.provincia n_provincia, municipio FROM usuario u,provincias p, municipios m WHERE  p.id=u.provincia AND u.localidad=m.id AND correo='".$correo."' and contraseña='".md5($pass)."' AND estado='ACTIVO'";
            $query=$this->db->query($sql);
            if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return "ERROR";
            }
        }

        public function obtener_usuario_admin($correo,$pass){
        $sql="SELECT * FROM usuario WHERE correo='".$correo."' and contraseña='".md5($pass)."' AND estado='ACTIVO'";
            $query=$this->db->query($sql);
            if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return "ERROR";
            }
        }
       public function registrarse($datos){
                $id_usuario="";
                $correo = $datos['correo'];
                $id_tipo_usuario = 2;
                $contraseña = $datos['contraseña'];
                $nombre = $datos['nombre'];
                $apellidos = $datos['apellidos'];
                $fecha_nac = $datos['fecha_nac'];
                $telefono = $datos['telefono'];
                $domicilio = $datos['domicilio'];
                $provincia = $datos['provincia'];
                $localidad = $datos['localidad'];

                $sql = "INSERT INTO usuario VALUES('$id_usuario','$id_tipo_usuario','$correo','$contraseña','$nombre','$apellidos','$fecha_nac','$telefono','$domicilio','$provincia','$localidad','ACTIVO')";
                $query=$this->db->query($sql);
                
        }

        public function recuperar_pass($correo){
            $sql = "SELECT * FROM usuario WHERE correo='".$correo."' AND estado='ACTIVO'";
            $query=$this->db->query($sql);
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
		
		Buenas se ha pedido un cambio de contraseña para la siguiente dirección : ".$correo.",
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
                $sql2 = "UPDATE usuario SET contraseña='".md5($pass)."' WHERE correo='".$correo."'";
                $this->db->query($sql2);
                return $pass;

            }
            else{
                return "ERROR";
            }
        }



        public function cargar_provincias(){
            $sql = "SELECT * FROM provincias ORDER BY provincia";
            $query=$this->db->query($sql);
            return $query->result();
            
        } 

        public function cargar_localidades($id){
            $sql = "SELECT * FROM municipios WHERE provincia_id=$id ORDER BY municipio";
            $query=$this->db->query($sql);
            return $query->result();
            
        }             

}


 ?>
