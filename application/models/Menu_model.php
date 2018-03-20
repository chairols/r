<?php

class Menu_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function set($datos) {
        $this->db->insert('addon_menu', $datos);
        return $this->db->insert_id();
    }
    
    public function gets_padres_ordenados($idpadre) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        addon_menu
                                    WHERE
                                        padre = '$idpadre' AND
                                        visible = '1'
                                    ORDER BY
                                        orden");
        return $query->result_array();              
    }
    
    public function gets() {
        $query = $this->db->query("SELECT *
                    FROM
                        addon_menu");
        return $query->result_array();
                    
    }
    
    public function get_where($where) {
        $query = $this->db->get_where('addon_menu', $where);
        
        return $query->row_array();
    }
    
    public function get_cantidad_pendientes($titulo) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        addon_menu
                                    WHERE
                                        titulo LIKE '%$titulo%' OR
                                        menu LIKE '%$titulo%'");
        
        return $query->row_array();
    }
    
    public function gets_where_titulo_limit($titulo, $pagina, $cantidad_por_pagina) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        addon_menu
                                    WHERE
                                        titulo LIKE '%$titulo%' OR
                                        menu LIKE '%$titulo%'
                                    ORDER BY
                                        titulo
                                    LIMIT $pagina, $cantidad_por_pagina");
        return $query->result_array();
    }
    
    public function obtener_menu_por_padre($idpadre, $idperfil) {
        $query = $this->db->query("SELECT m.*, pm.idperfil 
                                    FROM
                                        (addon_menu m
                                    LEFT JOIN
                                        addon_perfiles_menu pm
                                    ON
                                        m.idmenu = pm.idmenu AND
                                        pm.idperfil = '$idperfil')
                                    WHERE
                                        m.padre = '$idpadre'
                                    ORDER BY
                                        m.orden, m.menu" );
        return $query->result_array();
    }
    
    public function obtener_menu_por_padre_para_menu($idpadre, $idperfil) {
        $query = $this->db->query("SELECT m.*, pm.idperfil 
                                    FROM
                                        (addon_menu m
                                    INNER JOIN
                                        addon_perfiles_menu pm
                                    ON
                                        m.idmenu = pm.idmenu AND
                                        pm.idperfil = '$idperfil')
                                    WHERE
                                        m.padre = '$idpadre'
                                    ORDER BY
                                        m.orden, m.menu" );
        return $query->result_array();
    }
    
}
?>