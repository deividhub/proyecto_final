<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_model extends CI_Model {

        public function imagen()
        {
                $sql = "SELECT * FROM producto";
                $query=$this->db->query($sql);
                return $query->result();
        }



}


 ?>
