<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cuit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation',
            'pagination'
        ));
        $this->load->model(array(
            'vencimientos_cuit_model'
        ));
        $this->load->helper(array(
            'url'
        ));
        $this->r_session->check($this->session->all_userdata());
    }

    public function listar($pagina = 0) {
        $data['menu'] = $this->r_session->get_menu();
        
        $config = array();
        $per_page = 25;
        $codigo = $this->input->get('codigo');

        /*
         * inicio paginador
         */
        $total_rows = $this->vencimientos_cuit_model->get_cantidad($codigo);
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/cuit/listar/';
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

        $data['cuits'] = $this->vencimientos_cuit_model->gets_limit($codigo, $pagina, $config['per_page']);

        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('cuit/listar');
        $this->load->view('layout_ace/footer');
    }
    
    public function agregar() {
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = '/assets/js/cuit/agregar.js';

        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('cuit/agregar');
        $this->load->view('layout_ace/footer');
    }

    public function agregar_ajax() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('cuit', 'CUIT', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'cuit' => str_replace("-", "", $this->input->post('cuit'))
            );
            $resultado = $this->vencimientos_cuit_model->get_where($datos);
            if (!$resultado) {
                $datos = array(
                    'nombre' => $this->input->post('nombre'),
                    'cuit' => str_replace("-", "", $this->input->post('cuit')),
                    'color' => $this->input->post('color')
                );

                $id = $this->vencimientos_cuit_model->set($datos);

                if ($id) {
                    $json = array(
                        'status' => 'ok'
                    );
                    echo json_encode($json);
                } else {
                    $json = array(
                        'status' => 'error',
                        'data' => 'Ocurrió un error inesperado.'
                    );
                    echo json_encode($json);
                }
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => 'El CUIT ' . $this->input->post('cuit') . ' ya existe.'
                );
                echo json_encode($json);
            }
        }
    }

}

?>