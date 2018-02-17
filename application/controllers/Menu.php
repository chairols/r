<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'form_validation',
            'session',
            'pagination'
        ));
        $this->load->model(array(
            'menu_model'
        ));
    }
    
    public function index($pagina = 0) {
        $session = $this->session->all_userdata();
        $data['title'] = 'Listar Menú';
        $data['session'] = $session;
        $data['segmento'] = $this->uri->segment(1);
        //$data['menu'] = $this->r_session->get_menu();
        
        $per_page = 25;
        $titulo = '';
        if($this->input->post('titulo') !== null) {
            $titulo = $this->input->post('titulo');
        }
        
        /*
         * inicio paginador
         */
        $total_rows = $this->menu_model->get_cantidad_pendientes($titulo);
        $config['base_url'] = '/menu/index/';
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
        
        $data['menues'] = $this->menu_model->gets_where_titulo_limit($titulo, $pagina, $per_page);
        
        
        
        $data['mmenu'] = $this->menu_model->gets();
        foreach ($data['mmenu'] as $key => $value) {
            $datos = array(
                'idmenu' => $value['padre']
            );
            $data['mmenu'][$key]['padre'] = $this->menu_model->get_where($datos);
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('menu/index');
        $this->load->view('layout/footer');
    }
    
    public function agregar() {
        $data['prueba'] = array();
        
        $this->form_validation->set_rules('icono', 'Ícono', 'required');
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('href', 'HREF', 'required');
        $this->form_validation->set_rules('orden', 'Orden', 'required');
        
        if($this->form_validation->run() == FALSE) {
            
        } else {
            $data['prueba'] = $this->input->post();
            
            $datos = array(
                'icono' => $this->input->post('icono'),
                'menu' => $this->input->post('menu'),
                'titulo' => $this->input->post('titulo'),
                'href' => $this->input->post('href'),
                'orden' => $this->input->post('orden'),
                'padre' => $this->input->post('padre')
            );
            if($this->input->post('visible') == 'on')
                $datos['visible'] = '1';
            
            $id = $this->menu_model->set($datos);
        }
        
        $data['padres'] = $this->menu_model->gets_padres_ordenados(0);
        foreach ($data['padres'] as $key => $value) {
            $data['padres'][$key]['hijos'] = $this->menu_model->gets_padres_ordenados($value['idmenu']);
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('menu/agregar');
        $this->load->view('layout/footer');
    }
}
?>