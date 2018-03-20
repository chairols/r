<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
        
        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }
    
    public function index() {
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = '';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('dashboard/index');
        $this->load->view('layout/footer');
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