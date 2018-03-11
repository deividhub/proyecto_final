<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

        public function obtener_usuarios()
        {
                $sql = "SELECT * FROM usuario";
                $query=$this->db->query($sql);
                return $query->result();
        }



}


 ?>
