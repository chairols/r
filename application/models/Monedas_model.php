<?php

class Monedas_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_ultimo_valor_por_id($idmoneda) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        currency_exchange_history
                                    WHERE
                                        currency_id = '$idmoneda'
                                    ORDER BY
                                        currency_date DESC");
        
        return $query->row_array();
    }
}
?>