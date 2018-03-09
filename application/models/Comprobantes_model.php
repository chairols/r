<?php

class Comprobantes_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_ultimo_comprobante($puntodeventa, $tipocomprobante) {
        $query = $this->db->query("SELECT MAX(cbtenro) as ultimo
                                    FROM
                                        addon_comprobantes
                                    WHERE
                                        ptovta = '$puntodeventa' AND
                                        cbtetipo = '$tipocomprobante'");
        
        return $query->row_array();
    }
    
    public function set($datos) {
        $this->db->insert('addon_comprobantes', $datos);
        return $this->db->insert_id();
    }
    
    public function set_tributo($datos) {
        $this->db->insert('addon_comprobantes_tributos', $datos);
    }
    
    public function set_iva($datos) {
        $this->db->insert('addon_comprobantes_iva', $datos);
    }
}
?>