<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation',
            'pagination'
        ));
        $this->load->model(array(
            'perfiles_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }
    
    public function listar($pagina = 0) {
        $per_page = 25;
        $perfil = '';
        if($this->input->post('perfil') !== null) {
            $perfil = $this->input->post('perfil');
        }
        
        /*
         * inicio paginador
         */
        $total_rows = $this->perfiles_model->get_cantidad($perfil, '1');
        $config['base_url'] = '/perfiles/listar/';
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
        
        $data['perfiles'] = $this->perfiles_model->gets_limit($perfil, $pagina, $config['per_page'], 1);
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('perfiles/listar');
        $this->load->view('layout/footer');
    }

    public function agregar() {
        $this->load->view('layout/header');
        $this->load->view('layout/menu');
        $this->load->view('perfiles/agregar');
        $this->load->view('layout/footer');
    }

    public function agregar_ajax() {
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'perfil' => $this->input->post('perfil')
            );

            $resultado = $this->perfiles_model->get_where($datos);

            if (is_null($resultado)) {
                $datos = array(
                    'perfil' => $this->input->post('perfil')
                );

                $id = $this->perfiles_model->set($datos);

                if ($id > 0) {
                    $json = array(
                        'status' => 'ok'
                    );
                    echo json_encode($json);
                } else {
                    $json = array(
                        'status' => 'error',
                        'data' => '<p>Error desconocido, no se pudo agregar.</p>'
                    );
                    echo json_encode($json);
                }
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => '<p>El Perfil ' . $this->input->post('perfil') . ' ya existe.</p>'
                );
                echo json_encode($json);
            }
        }
    }

}

?>