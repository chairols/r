<?php

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'form_validation',
            'session',
            'r_session',
            'pagination'
        ));
        $this->load->model(array(
            'usuarios_model',
            'perfiles_model'
        ));
        $this->load->helper(array(
            'url'
        ));
    }

    public function listar($pagina = 0) {
        $per_page = 25;
        $usuario = '';
        if($this->input->post('usuario') !== null) {
            $usuario = $this->input->post('usuario');
        }
        
        /*
         * inicio paginador
         */
        $total_rows = $this->usuarios_model->get_cantidad($usuario, 'A');
        $config['base_url'] = '/usuarios/listar/';
        $config['total_rows'] = $total_rows['cantidad'];
        $config['per_page'] = $per_page;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $total_rows['cantidad'];
        /*
         * fin paginador
         */
        
        $data['usuarios'] = $this->usuarios_model->gets_limit($usuario, $pagina, $config['per_page'], 'A');
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('usuarios/listar');
        $this->load->view('layout/footer');
    }
    
    public function login() {
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $usuario = $this->usuarios_model->get_usuario($this->input->post('usuario'), sha1($this->input->post('password')));
            if (!empty($usuario)) {
                $perfil = $this->usuarios_model->get_perfil($usuario['user_id']);
                
                $datos = array(
                    'SID' => $usuario['user_id'],
                    'usuario' => $usuario['user'],
                    'nombre' => $usuario['first_name'],
                    'apellido' => $usuario['last_name'],
                    'correo' => $usuario['email'],
                    'botonmenu' => 0,
                    'perfil' => $perfil['idperfil']
                );
                $this->session->set_userdata($datos);
                redirect('/dashboard/', 'refresh');
            }
        }


        $session = $this->session->all_userdata();
        if (!empty($session['SID'])) {
            redirect('/dashboard/', 'refresh');
        } else {
            $this->load->view('usuarios/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/usuarios/login/', 'refresh');
    }
    
    public function modificar($idusuario) {
        
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        
        if($this->form_validation->run() == FALSE) {
            
        } else {
            $datos = array(
                'idperfil' => $this->input->post('perfil')
            );
            $this->usuarios_model->update_perfil($datos, $idusuario);
        }
        $datos = array(
            'user_id' => $idusuario
        );
        $data['usuario'] = $this->usuarios_model->get_where($datos);
        $data['perfil'] = $this->usuarios_model->get_perfil($idusuario);
        
        $data['perfiles'] = $this->perfiles_model->gets();
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('usuarios/modificar');
        $this->load->view('layout/footer');
    }
    
    public function modificar_ajax() {
        
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        if($this->input->post('password') != '') {
            $this->form_validation->set_rules('password', 'Password', 'matches[password2]');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        
        
        
        if($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            
            /*
             *   Falta desarrollo
             */
            $datos = array(
                'idperfil' => $this->input->post('perfil')
            );
            $this->usuarios_model->update_perfil($datos, $this->input->post('idusuario')); 
            $json = array(
                        'status' => 'ok'
                    );
                    echo json_encode($json);
        }
    }
    
}

?>