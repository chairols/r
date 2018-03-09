<?php

class Usuarios_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_usuario($usuario, $password) {
        $query = $this->db->query("SELECT 
                                        user_id,
                                        user,
                                        first_name,
                                        last_name,
                                        email,
                                        profile_id
                                    FROM
                                        core_user
                                    WHERE
                                        user = '$usuario' AND
                                        password = '$password'");
        return $query->row_array();
    }
    
    public function get_cantidad($code, $status) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        core_user
                                    WHERE
                                        (user LIKE '%$code%' OR
                                        first_name LIKE '%$code%' OR
                                        last_name LIKE '%$code%') AND
                                        status LIKE '$status'");
        return $query->row_array();
    }
    
    public function gets_limit($code, $pagina, $cantidad, $status) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        core_user
                                    WHERE
                                        (user LIKE '%$code%' OR
                                        first_name LIKE '%$code%' OR
                                        last_name LIKE '%$code%') AND
                                        status LIKE '$status' 
                                    ORDER BY
                                        user
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
    
    public function get_where($where) {
        $query = $this->db->get_where('core_user', $where);
        
        return $query->row_array();
    }
    
    public function get_perfil($idusuario) {
        $where = array(
            'idusuario' => $idusuario
        );
        $query = $this->db->get_where('addon_usuarios_perfiles', $where);
        
        return $query->row_array();
    }
    
    public function update_perfil($where, $idusuario) {
        $this->db->update('addon_usuarios_perfiles', $where, array('idusuario'=>$idusuario));
    } 
}
?>
