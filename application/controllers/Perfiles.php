<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
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
    
}

?>