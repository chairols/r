<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listas_de_precios extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'pagination'
        ));
        $this->load->model(array(
            'listas_de_precios_model',
            'marcas_model'
        ));
        $this->load->helper(array(
            'url'
        ));
        $this->r_session->check($this->session->all_userdata());
    }
    
    public function comparaciones($pagina = 0) {
        $data['menu'] = $this->r_session->get_menu();
        
        $per_page = 25;
        $texto = $this->input->get('texto');
        
        
        /*
         * inicio paginador
         */
        $total_rows = $this->listas_de_precios_model->get_cantidad_comparaciones('A');
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/listas_de_precios/comparaciones/';
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
        
        $data['comparaciones'] = $this->listas_de_precios_model->gets_pendientes_limit($pagina, $config['per_page'], 'A');
        foreach ($data['comparaciones'] as $key => $value) {
            $data['comparaciones'][$key]['marcas'] = $this->listas_de_precios_model->gets_marcas_relacionadas($value['comparation_id']);
            $data['comparaciones'][$key]['companias'] = $this->listas_de_precios_model->gets_companias_relacionadas($value['comparation_id']);
        }
        
        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('listas_de_precios/comparaciones');
        $this->load->view('layout_ace/footer');
    }
    
    public function modificar($idcomparacion = 0, $pagina = 0) {
        $this->benchmark->mark('inicio');
        
        $data['menu'] = $this->r_session->get_menu();
        
        $per_page = 25;
        $data['generico'] = $this->input->get('generico');
        $data['proveedor'] = $this->input->get('proveedor');
        
        /*
         * inicio paginador
         */
        $total_rows = $this->listas_de_precios_model->get_cantidad_comparaciones_lista($idcomparacion, $data['generico'], $data['proveedor'], 'A');
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/listas_de_precios/modificar/'.$idcomparacion.'/';
        $config['total_rows'] = count($total_rows);
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
        $data['total_rows'] = $config['total_rows'];
        /*
         * fin paginador
         */
        
        $data['items'] = $this->listas_de_precios_model->gets_comparaciones_lista_limit($idcomparacion, $pagina, $config['per_page'], $data['generico'], $data['proveedor'], 'A');
        foreach ($data['items'] as $key => $value) {
            $data['items'][$key]['articulos'] = $this->listas_de_precios_model->gets_precios_por_comparacion_y_generico($idcomparacion, $value['abstract_id'], 'A');
        }
        
        $this->benchmark->mark('fin');
        $data['benchmark'] = $this->benchmark->elapsed_time('inicio', 'fin');
        
        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('listas_de_precios/modificar');
        $this->load->view('layout_ace/footer');
    }
}

?>