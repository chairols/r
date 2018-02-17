<?php

class Articulos_genericos_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function gets_pendientes_limit($code, $pagina, $cantidad, $status, $relation_status) {
        $query = $this->db->query("SELECT pa.abstract_id, pa.code, pc.title
                                    FROM
                                        product_abstract pa,
                                        product_category pc
                                    WHERE
                                        pa.code LIKE '%$code%' AND
                                        pa.status LIKE '$status' AND
                                        pa.relation_status LIKE '$relation_status' AND
                                        pa.category_id = pc.category_id
                                    ORDER BY
                                        pa.code
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
    
    public function get_cantidad_pendientes($code, $status, $relation_status) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        product_abstract
                                    WHERE
                                        code LIKE '%$code%' AND
                                        status LIKE '$status' AND
                                        relation_status LIKE '$relation_status'");
        return $query->row_array();
    }
    
    public function gets_articulos_asociados($abstract_id) {
        $query = $this->db->query("SELECT p.code, pb.name
                                    FROM
                                        product p, 
                                        product_brand pb
                                    WHERE
                                        p.abstract_id = $abstract_id AND
                                        p.status LIKE 'A' AND
                                        p.discontinued LIKE 'N' AND
                                        p.brand_id = pb.brand_id");
        return $query->result_array();
    }
    
    public function get_stock_articulos_asociados($abstract_id) {
        $query = $this->db->query("SELECT SUM(stock) as cantidad
                                    FROM
                                        product 
                                    WHERE
                                        abstract_id = '$abstract_id'");
        return $query->row_array();
    }
}
?>