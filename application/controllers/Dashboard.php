<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
        $this->load->model(array(
            'monedas_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function index() {
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = '';
        
        $data['dolar'] = $this->monedas_model->get_ultimo_valor_por_id(2);

        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('dashboard/index');
        $this->load->view('layout_ace/footer');
    }

    public function index2() {
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = '';

        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('dashboard/index2');
        $this->load->view('layout_ace/footer');
    }

}

?>