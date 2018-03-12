<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'wsfe/wsfe',
            'r_session'
        ));
        $this->load->model(array(
            'comprobantes_model',
            'menu_model'
        ));
    }

    public function factura($numerofactura = 8) {
        /*
         * Certificado de prueba
         */
        $certificado = "application/libraries/wsfe/hernan.crt";
        $clave = "application/libraries/wsfe/hernan.privada";
        $urlwsaa = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms";

        /*
         * Certificado REAL
         */
        $certificado = "application/libraries/wsfe/roller/roller.crt";
        $clave = "application/libraries/wsfe/roller/privada.key";
        $urlwsaa = "https://wsaa.afip.gov.ar/ws/services/LoginCms";







        $CUIT = 33647656779;
        $urlwsaa = URLWSAA;

        $wsfe = new WsFE();
        $wsfe->CUIT = floatval($CUIT);
        $wsfe->setURL(URLWSW);

        $PtoVta = 3;
        $TipoComp = 1;
        $UltimoNroComprobante = 0;

        if ($wsfe->Login($certificado, $clave, $urlwsaa)) {
            if (!$wsfe->RecuperaLastCMP($PtoVta, $TipoComp)) {
                echo $wsfe->ErrorDesc;
            } else {
                $r = $wsfe->getUltimoComprobanteAutorizado($PtoVta, $TipoComp);
                $UltimoNroComprobante = $r->CbteNro;
            }
        }


        $ultimo = $this->comprobantes_model->get_ultimo_comprobante($PtoVta, $TipoComp);
        if (is_null($ultimo['ultimo'])) {
            $ultimo['ultimo'] = 0;
        }

        var_dump($ultimo);


        $respuesta = array();

        for ($i = $ultimo['ultimo'] + 1; $i <= $UltimoNroComprobante; $i++) {
            if ($wsfe->Login($certificado, $clave, $urlwsaa)) {
                if (!$wsfe->RecuperaLastCMP($PtoVta, $TipoComp)) {
                    echo $wsfe->ErrorDesc;
                } else {
                    echo "<pre>";
                    $respuesta = $wsfe->getDatosFactura($TipoComp, $PtoVta, $i);
                    print_r($respuesta);
                    //print_r($wsfe->getUltimoComprobanteAutorizado($PtoVta, $TipoComp));
                    //print_r($wsfe->getDatosFactura($TipoComp, $PtoVta, $numerofactura));
                    echo "</pre>";
                }
            }

            $datos = array(
                'concepto' => $respuesta->Concepto,
                'doctipo' => $respuesta->DocTipo,
                'docnro' => $respuesta->DocNro,
                'cbtenro' => $respuesta->CbteDesde,
                'cbtefch' => $respuesta->CbteFch,
                'imptotal' => $respuesta->ImpTotal,
                'imptotconc' => $respuesta->ImpTotConc,
                'impneto' => $respuesta->ImpNeto,
                'impopex' => $respuesta->ImpOpEx,
                'imptrib' => $respuesta->ImpTrib,
                'impiva' => $respuesta->ImpIVA,
                'fchservdesde' => $respuesta->FchServDesde,
                'fchservhasta' => $respuesta->FchServHasta,
                'fchvtopago' => $respuesta->FchVtoPago,
                'monid' => $respuesta->MonId,
                'moncotiz' => $respuesta->MonCotiz,
                'resultado' => $respuesta->Resultado,
                'codautorizacion' => $respuesta->CodAutorizacion,
                'emisiontipo' => $respuesta->EmisionTipo,
                'fchvto' => $respuesta->FchVto,
                'fchproceso' => $respuesta->FchProceso,
                'ptovta' => $respuesta->PtoVta,
                'cbtetipo' => $respuesta->CbteTipo
            );


            $idcomprobante = $this->comprobantes_model->set($datos);

            if (isset($respuesta->Tributos)) {
                foreach ($respuesta->Tributos as $tributo) {
                    var_dump($tributo);
                    $datos = array(
                        'id' => $tributo->Id,
                        'descripcion' => $tributo->Desc,
                        'baseimp' => $tributo->BaseImp,
                        'alic' => $tributo->Alic,
                        'importe' => $tributo->Importe,
                        'idcomprobante' => $idcomprobante
                    );

                    var_dump($datos);

                    $this->comprobantes_model->set_tributo($datos);
                }
            }

            if (isset($respuesta->Iva)) {
                foreach ($respuesta->Iva as $iva) {
                    var_dump($iva);
                    $datos = array(
                        'id' => $iva->Id,
                        'baseimp' => $iva->BaseImp,
                        'importe' => $iva->Importe,
                        'idcomprobante' => $idcomprobante
                    );

                    var_dump($datos);

                    $this->comprobantes_model->set_iva($datos);
                }
            }
        }
    }

    public function jstree() {
        $data['padres'] = $this->menu_model->gets_padres_ordenados(0);
        foreach ($data['padres'] as $key => $value) {
            $data['padres'][$key]['hijos'] = $this->menu_model->gets_padres_ordenados($value['idmenu']);
            foreach ($data['padres'][$key]['hijos'] as $k => $v) {
                $data['padres'][$key]['hijos'][$k]['hijos'] = $this->menu_model->gets_padres_ordenados($v['idmenu']);
            }
        }
        $this->load->view('prueba/jstree', $data);
    }

    public function actualizar_checkbox() {
        var_dump($this->input->post());
    }

    public function menu() {

        $menu = $this->r_session->get_menu();
        echo "<pre>";
        print_r($menu);
        echo "</pre>";
    }

}

?>