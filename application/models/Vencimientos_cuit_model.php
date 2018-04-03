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
    
    public function get_cantidad($code) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        addon_vencimientos_cuit
                                    WHERE
                                        nombre LIKE '%$code%' OR
                                        cuit LIKE '%code%'");
        return $query->row_array();
    }
    
    public function gets_limit($code, $pagina, $cantidad) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        addon_vencimientos_cuit
                                    WHERE
                                        nombre LIKE '%$code%' OR
                                        cuit LIKE '%$code%' 
                                    ORDER BY
                                        nombre
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
    
    public function gets() {
        $query = $this->db->query("SELECT *
                                    FROM    
                                        addon_vencimientos_cuit");
        return $query->result_array();
    }
}
?>