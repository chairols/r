<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cuit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation'
        ));
        $this->load->model(array(
            'vencimientos_cuit_model'
        ));
        $this->load->helper(array(
            'url'
        ));
        $this->r_session->check($this->session->all_userdata());
    }

    public function listar() {
        $data['menu'] = $this->r_session->get_menu();
        
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