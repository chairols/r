<?php

class Vencimientos_conceptos_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function truncate() {
        $this->db->query("truncate table addon_vencimientos_conceptos");
    }
    
    public function set($datos) {
        $this->db->insert('addon_vencimientos_conceptos', $datos);
        return $this->db->insert_id();
    }
}

?>