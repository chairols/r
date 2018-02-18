<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation'
        ));
        $this->load->model(array(
            'perfiles_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
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