<?php

class Listas_de_precios_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_cantidad_comparaciones($status) {
        $query = $this->db->query("SELECT count(*) as cantidad
                                    FROM
                                        product_comparation pc
                                    WHERE
                                        pc.status = '$status'");
        return $query->row_array();
    }
    
    public function gets_pendientes_limit($pagina, $cantidad, $status) {
        $query = $this->db->query("SELECT * 
                                    FROM
                                        product_comparation pc
                                    WHERE
                                        pc.status = '$status'
                                    ORDER BY
                                        pc.creation_date DESC
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
    
    public function gets_marcas_relacionadas($idcomparacion) {
        $query = $this->db->query("SELECT *
                                    FROM 
                                        product_comparation_item pci,
                                        product_brand pb
                                    WHERE
                                        pci.brand_id = pb.brand_id AND
                                        pci.comparation_id = '$idcomparacion'
                                    GROUP BY
                                        pb.brand_id");
        return $query->result_array();
    }
    
    public function gets_companias_relacionadas($idcomparacion) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        product_comparation_item pci,
                                        company c
                                    WHERE
                                        pci.company_id = c.company_id AND
                                        pci.comparation_id = '$idcomparacion'
                                    GROUP BY
                                        c.company_id");
        return $query->result_array();
    }
    
    public function get_cantidad_comparaciones_lista($idcomparacion, $articulo, $proveedor, $status) {
//        $query = $this->db->query("SELECT pci.abstract_id
//                                    FROM
//                                        product_comparation_item pci
//                                    INNER JOIN
//                                        product_abstract pa
//                                    ON
//                                        pci.abstract_id = pa.abstract_id AND
//                                        pci.comparation_id = '$idcomparacion' AND
//                                        pci.status = '$status'
//                                    GROUP BY
//                                        pci.abstract_id");
        
        $query = $this->db->query("SELECT pci.abstract_id
                                    FROM
                                        ((product_comparation_item pci
                                    INNER JOIN
                                        product_abstract pa
                                    ON
                                        pci.abstract_id = pa.abstract_id)
                                    INNER JOIN
                                        company c
                                    ON
                                        pci.company_id = c.company_id)
                                    WHERE
                                        (pci.comparation_id = '$idcomparacion' AND
                                        pci.status = '$status') AND
                                        (pa.code LIKE '%$articulo%' AND
                                        c.name LIKE '%$proveedor%')
                                    GROUP BY
                                        pci.abstract_id");
        return $query->result_array();
    }
    
    public function gets_comparaciones_lista_limit($idcomparacion, $pagina, $cantidad, $articulo, $proveedor, $status) {
//        $query = $this->db->query("SELECT pa.code as generico, pci.abstract_stock, pci.abstract_stock_diff, pci.relation_id, pci.abstract_id
//                                    FROM
//                                        product_comparation_item pci
//                                    INNER JOIN
//                                        product_abstract pa
//                                    ON
//                                        pci.abstract_id = pa.abstract_id AND
//                                        pci.comparation_id = '$idcomparacion' AND
//                                        pci.status = '$status'
//                                    GROUP BY
//                                        pci.abstract_id
//                                    ORDER BY
//                                        generico
//                                    LIMIT $pagina, $cantidad");
        
        
        $query = $this->db->query("SELECT pa.code as generico, pci.abstract_stock, pci.abstract_stock_diff, pci.relation_id, pci.abstract_id
                                    FROM
                                        ((product_comparation_item pci
                                    INNER JOIN
                                        product_abstract pa
                                    ON
                                        pci.abstract_id = pa.abstract_id)
                                    INNER JOIN
                                        company c
                                    ON
                                        pci.company_id = c.company_id)
                                    WHERE
                                        (pci.comparation_id = '$idcomparacion' AND
                                        pci.status = '$status') AND
                                        (pa.code LIKE '%$articulo%' AND
                                        c.name LIKE '%$proveedor%')
                                    GROUP BY
                                        pci.abstract_id
                                    ORDER BY
                                        generico
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
    
    public function gets_precios_por_comparacion_y_generico($idcomparacion, $idgenerico, $status) {
//        $query = $this->db->query("SELECT c.name as compania, pb.name as marca, pr.code as codigo_proveedor, p.code as codigo_roller, pci.price as precio, pci.stock as stock_proveedor, pci.abstract_stock
//                                    FROM
//                                        product_comparation_item pci,
//                                        product p,
//                                        company c,
//                                        product_brand pb,
//                                        product_relation pr
//                                    WHERE
//                                        pci.product_id = p.product_id AND
//                                        pci.company_id = c.company_id AND
//                                        pci.brand_id = pb.brand_id AND
//                                        pci.relation_id = pr.relation_id AND
//                                        pci.comparation_id = '$idcomparacion' AND
//                                        pci.abstract_id = '$idgenerico' AND
//                                        pci.status = '$status'
//                                    ORDER BY
//                                        pci.price");
        
        $query = $this->db->query("SELECT c.name as compania, pb.name as marca, pr.code as codigo_proveedor, p.code as codigo_roller, pci.price as precio, pci.stock as stock_proveedor, pci.abstract_stock
                                    FROM
                                        ((((product_comparation_item pci
                                    INNER JOIN
                                        product p
                                    ON
                                        pci.product_id = p.product_id AND
                                        pci.comparation_id = '$idcomparacion' AND
                                        pci.abstract_id = '$idgenerico' AND
                                        pci.status = '$status')
                                    INNER JOIN
                                        company c
                                    ON
                                        pci.company_id = c.company_id)
                                    INNER JOIN
                                        product_brand pb
                                    ON
                                        pci.brand_id = pb.brand_id)
                                    INNER JOIN 
                                        product_relation pr
                                    ON
                                        pci.relation_id = pr.relation_id)
                                    ORDER BY
                                        pci.price");
        return $query->result_array();
    }
}
?>