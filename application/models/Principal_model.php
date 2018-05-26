<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_model extends CI_Model {

      public function obtener_usuario($correo,$pass){
         	$sql = "SELECT * FROM usuario WHERE correo='".$correo."' and contraseña='".md5($pass)."' AND estado='ACTIVO'";
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
