<?php

class Marcas_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function gets() {
        $query = $this->db->query("SELECT *
                                    FROM
                                        product_brand
                                    WHERE
                                        status = 'A'");
        return $query->result_array();
    }
    
    public function get_where($where) {
        $query = $this->db->get_where('product_brand', $where);
        
        return $query->row_array();
    }
}
?>