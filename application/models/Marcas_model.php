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
}
?>