<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'wsfe/wsfe'
        ));
    }
    
    public function factura($numerofactura = 8) {
        $certificado = "application/libraries/wsfe/hernan.crt";
        $clave = "application/libraries/wsfe/hernan.privada";
        
        
        $CUIT = 33647656779;
        $urlwsaa = URLWSAA;
        
        $wsfe = new WsFE();
        $wsfe->CUIT = floatval($CUIT);
        $wsfe->setURL(URLWSW);
        
        $PtoVta = 3;
        $TipoComp = 1;
        
        
        
        if ($wsfe->Login($certificado, $clave, $urlwsaa)) { 
            if (!$wsfe->RecuperaLastCMP($PtoVta, $TipoComp)) {
                echo $wsfe->ErrorDesc;
            } else {
                echo "<pre>";
                print_r($wsfe->getUltimoComprobanteAutorizado($PtoVta, $TipoComp));
                print_r($wsfe->getDatosFactura($TipoComp, $PtoVta, $numerofactura));
                echo "</pre>";
            }
        }
    }
}
?>