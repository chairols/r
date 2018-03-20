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
                                        core_user cu,
                                        addon_usuarios_perfiles up,
                                        addon_perfiles p
                                    WHERE
                                        cu.user_id = up.idusuario AND
                                        up.idperfil = p.idperfil AND
                                        (cu.user LIKE '%$code%' OR
                                        cu.first_name LIKE '%$code%' OR
                                        cu.last_name LIKE '%$code%') AND
                                        cu.status LIKE '$status'");
        return $query->row_array();
    }
    
    public function gets_limit($code, $pagina, $cantidad, $status) {
        $query = $this->db->query("SELECT cu.*, p.perfil
                                    FROM
                                        core_user cu,
                                        addon_usuarios_perfiles up,
                                        addon_perfiles p
                                    WHERE
                                        cu.user_id = up.idusuario AND
                                        up.idperfil = p.idperfil AND
                                        (cu.user LIKE '%$code%' OR
                                        cu.first_name LIKE '%$code%' OR
                                        cu.last_name LIKE '%$code%') AND
                                        cu.status LIKE '$status' 
                                    ORDER BY
                                        cu.user
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
