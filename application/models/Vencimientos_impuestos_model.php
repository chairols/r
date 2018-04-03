<?php

class Vencimientos_impuestos_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function truncate() {
        $this->db->query("truncate table addon_vencimientos_impuestos");
    }
    
    public function set($datos) {
        $this->db->insert('addon_vencimientos_impuestos', $datos);
        return $this->db->insert_id();
    }
    
    public function get_where($where) {
        $query = $this->db->get_where('addon_vencimientos_impuestos', $where);
        
        return $query->row_array();
    }
}

?>