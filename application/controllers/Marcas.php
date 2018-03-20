<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
        $this->load->model(array(
            'marcas_model'
        ));
        $this->load->helper(array(
            'url'
        ));
        $this->r_session->check($this->session->all_userdata());
    }
    
    public function listar() {
        $data['menu'] = $this->r_session->get_menu();
        $data['marcas'] = $this->marcas_model->gets();
        
        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('marcas/listar');
        $this->load->view('layout_ace/footer');
    }
}

?>