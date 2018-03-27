<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_model extends CI_Model {

      public function obtener_usuario($correo,$contraseña){
         	$sql = "SELECT * FROM usuario WHERE correo='".$correo."' and contraseña='".$contraseña."'";
            $query=$this->db->query($sql);
            return $query->result();
        }
        /*public function imagen()
        {
                $sql = "SELECT * FROM producto";
                $query=$this->db->query($sql);
                return $query->result();
        }*/

}


 ?>
