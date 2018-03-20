<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articulos_genericos extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'pagination'
        ));
        $this->load->model(array(
            'articulos_genericos_model'
        ));
        $this->load->helper(array(
            'url'
        ));
        $this->r_session->check($this->session->all_userdata());
    }
    
    public function pendientes($pagina = 0) {
        $data['menu'] = $this->r_session->get_menu();
        
        $per_page = 25;
        $code = '';
        if($this->input->post('code') !== null) {
            $code = $this->input->post('code');
        }
        
        /*
         * inicio paginador
         */
        $total_rows = $this->articulos_genericos_model->get_cantidad_pendientes($code, 'A', 'A');
        $config['base_url'] = '/articulos_genericos/pendientes/';
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
        
        
        
        $data['productos'] = $this->articulos_genericos_model->gets_pendientes_limit($code, $pagina, $config['per_page'], 'A', 'A');
        foreach ($data['productos'] as $key => $value) {
            $data['productos'][$key]['productos'] = $this->articulos_genericos_model->gets_articulos_asociados($value['abstract_id']);
            $stock = $this->articulos_genericos_model->get_stock_articulos_asociados($value['abstract_id']);
            $data['productos'][$key]['stock'] = $stock['cantidad'];
        }
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('articulos_genericos/pendientes');
        $this->load->view('layout/footer');
    }
    
    public function finalizados($pagina = 0) {
        /*
         *   Revisar porque fue copy-paste de pendientes y se modificó solo un valor en un parametro de un model
         */
        $data['menu'] = $this->r_session->get_menu();
        $per_page = 25;
        $code = '';
        if($this->input->post('code') !== null) {
            $code = $this->input->post('code');
        }
        
        /*
         * inicio paginador
         */
        $total_rows = $this->articulos_genericos_model->get_cantidad_pendientes($code, 'A', 'F');
        $config['base_url'] = '/articulos_genericos/finalizados/';
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
        /*
         * fin paginador
         */
        
        
        $data['total_rows'] = $total_rows['cantidad'];
        $data['productos'] = $this->articulos_genericos_model->gets_pendientes_limit($code, $pagina, $config['per_page'], 'A', 'F');
        foreach ($data['productos'] as $key => $value) {
            $data['productos'][$key]['productos'] = $this->articulos_genericos_model->gets_articulos_asociados($value['abstract_id']);
            $stock = $this->articulos_genericos_model->get_stock_articulos_asociados($value['abstract_id']);
            $data['productos'][$key]['stock'] = $stock['cantidad'];
        }
        
        
        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('articulos_genericos/pendientes');
        $this->load->view('layout_ace/footer');
    }
}
?>