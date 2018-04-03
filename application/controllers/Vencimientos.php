<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vencimientos extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
        $this->load->model(array(
            'vencimientos_cuit_model',
            'vencimientos_impuestos_model',
            'vencimientos_conceptos_model'
        ));
        $this->load->helper(array(
            'url'
        ));
        $this->r_session->check($this->session->all_userdata());
    }
    
    public function listar($pagina = 0) {
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = "/assets/js/vencimientos/listar.js";
        
        $cuits = $this->vencimientos_cuit_model->gets();
        $vencimientos = array();
        foreach($cuits as $cuit) {
            $vencimientos[$cuit['cuit']] = json_decode(file_get_contents("https://soa.afip.gob.ar/av/v1/vencimientos/".$cuit['cuit']));
            foreach($vencimientos[$cuit['cuit']]->data as $key => $value) {
                $where = array(
                    'idimpuesto' => $value->idImpuesto
                );
                $vencimientos[$cuit['cuit']]->data[$key]->impuesto = $this->vencimientos_impuestos_model->get_where($where);
                $where = array(
                    'idconcepto' => $value->idConcepto
                );
                $vencimientos[$cuit['cuit']]->data[$key]->concepto = $this->vencimientos_conceptos_model->get_where($where);
            }
        }
        
        $events = '';
        
        foreach($cuits as $cuit) {
            foreach($vencimientos[$cuit['cuit']]->data as $vencimiento) {
                $events .= '{
                            title: \''.$cuit['nombre'].'\',
                            start: \''.$vencimiento->vencimiento.'\',
                            allDay: true,
                            color: \''.$cuit['color'].'\',
                            operacion: \''.$vencimiento->tipoOperacion.'\',
                            impuesto: \''.$vencimiento->impuesto['impuesto'].'\',
                            concepto: \''.$vencimiento->concepto['concepto'].'\',';
                if(isset($vencimiento->formularios)) {
                    $events .= 'formularios: \''.$vencimiento->formularios.'\'';
                } else {
                    $events .= 'formularios: \'\'';
                }
                $events .= '},';
                            
            }
            
        }
        
        $data['events'] = $events;
        $data['vencimientos'] = $vencimientos;
        
        $this->load->view('layout_ace/header', $data);
        $this->load->view('layout_ace/menu');
        $this->load->view('vencimientos/listar');
        $this->load->view('layout_ace/footer');
    }
}
?>