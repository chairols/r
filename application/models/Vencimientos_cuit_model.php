<?php

class Vencimientos_cuit_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_where($where) {
        $query = $this->db->get_where('addon_vencimientos_cuit', $where);
        
        return $query->row_array();
    }
    
    public function set($datos) {
        $this->db->insert('addon_vencimientos_cuit', $datos);
        return $this->db->insert_id();
    }
}
?>