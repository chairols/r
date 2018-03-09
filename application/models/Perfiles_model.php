<?php

class Perfiles_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_where($where) {
        $query = $this->db->get_where('addon_perfiles', $where);
        
        return $query->row_array();
    }
    
    public function set($datos) {
        $this->db->insert('addon_perfiles', $datos);
        return $this->db->insert_id();
    }
    
    public function get_cantidad($code, $activo) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        addon_perfiles
                                    WHERE
                                        perfil LIKE '%$code%' AND
                                        activo = '$activo'");
        return $query->row_array();
    }
    
    public function gets_limit($perfil, $pagina, $cantidad, $activo) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        addon_perfiles
                                    WHERE
                                        perfil LIKE '%$perfil%' AND
                                        activo = '$activo' 
                                    ORDER BY
                                        perfil
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
    
    public function gets() {
        $query = $this->db->query("SELECT *
                                    FROM
                                        addon_perfiles
                                    WHERE
                                        activo = '1'
                                    ORDER BY
                                        perfil");
        return $query->result_array();
    }
}
?>