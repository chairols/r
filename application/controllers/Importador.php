<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importador extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'movimientos_model',
            'productos_model',
            'vencimientos_impuestos_model',
            'vencimientos_conceptos_model'
        ));
    }
    
    public function movimientos() {
        
        $this->benchmark->mark('inicio');
        $this->movimientos_model->truncate();
        
        $fp = fopen("http://sistema.local/assets/MOVI", "r");
        $i = 0;
        while(!feof($fp)) {
            $linea = fgets($fp);
            $array['articulo'] = trim(substr($linea, 0, 17));
            $array['idmarca'] = trim(substr($linea, 18, 4)) * 1;
            $array['referencia'] = trim(substr($linea, 23, 9)) * 1;
            $array['comprobante'] = trim(substr($linea, 33, 5));
            $anio = substr($linea, 46, 2);
            $mes = substr($linea, 43, 2);
            $dia = trim(substr($linea, 40, 2));
            if($anio > 90) {
                $anio = '19'.$anio;
            } else {
                $anio = '20'.$anio;
            }
            $array['fecha'] = $anio.'-'.$mes.'-'.$dia;
            $array['entrada'] = trim(substr($linea, 50, 9)) * 1;
            $array['salida'] = trim(substr($linea, 60, 9)) * 1;
            $array['saldo'] = trim(substr($linea, 71, 8));
            $signo = substr($linea, 79, 1);
            if($signo == '-')
                $array['saldo'] = $array['saldo'] * -1;
            $array['valor'] = trim(substr($linea, 82, 10)) * 1;
            $array['almacen'] = trim(substr($linea, 93, 2)) * 1;
            $array['empresa'] = trim(substr($linea, 98, 4));
            
            
            $this->movimientos_model->set($array);
            $i++;
            
            if(($i % 1000) == 0) 
                var_dump($i);
            
        }
        
        $this->benchmark->mark('fin');
        
        echo $this->benchmark->elapsed_time('inicio', 'fin');
        
    }
    
    
    public function actualizar_product() {
        
        $this->benchmark->mark('inicio');
        $cantidad = $this->productos_model->get_cantidad_productos();
        
        var_dump($cantidad);
        
        
        
        $fp = fopen("http://sistema.local/assets/ARTICULO.TXT", "r");
        $count = 0;
        $init = 0;
        $porcentaje = 0;
        
        while(!feof($fp)) {
            $linea = fgets($fp);
            $array = preg_split('/;/', $linea);
            $count++;
            $init++;
            
            if(round(($count * 100 / $cantidad['cantidad'])) > $porcentaje) {
                $porcentaje = round(($count * 100 / $cantidad['cantidad']), 0, PHP_ROUND_HALF_DOWN);
                echo $porcentaje." %\n";
            }
            
            
            //  CARACTERES AL FINAL DEL VALOR
            //  { = POSITIVO
            //  } = NEGATIVO
            //  
            //  [0] = ARTICULO
            //  [1] = MARCA
            //  [2] = LINEA
            //  [3] = NUMERO DE ORDEN
            //  [4] = ESTANTERIA  
            //  [6] = PRECIO Lista 1   
            //  [9] = COSTO FOB   
            //  [11] = COSTO DESPACHADO 
            //  [13] = STOCK MINIMO  
            //  [19] = STOCK ALMACEN 1
            //  [20] = STOCK ALMACEN 2
            //  [21] = PEDIDO DE IMPORTACION
            //  [41] = OBSERVACIONES
            //  [42] = DESCRIPCION
            
            
            
            //if($array[0] == "6206 C3             ") {
                $where = array(
                    'code' => trim($array[0]),
                    'brand_id' => $array[1]
                );
                
                $resultado = $this->productos_model->get_where($where);
                
                
                $convmap = array(0x80, 0x10ffff, 0, 0xffffff);
                $array[4] = preg_replace('/\x{EF}\x{BF}\x{BD}/u', '', mb_encode_numericentity(trim($array[4]), $convmap, "UTF-8"));
                
                
                //$array[4] = utf8_encode(trim($array[4]));
                //$array[4] = trim($array[4]);
                $array[6] = ($array[6] / 1000);  //  price
                $array[9] = ($array[9] / 1000);  //  price_fob
                $array[11] = ($array[11] / 1000); //  price_dispatch
                $array[13] = ($array[13] / 1000);  // stock_min
                $array[14] = ($array[14] / 1000);  // stock_max
                
                $signo = null;
                if($array[19][9] == '}') {
                    $signo = -1;
                } else {
                    $signo = 1;
                }
                $array[19] = ((substr($array[19], 0, 9) / 100) * $signo);
                
                $signo = null;
                if($array[20][9] == '}') {
                    $signo = -1;
                } else {
                    $signo = 1;
                }
                $array[20] = ((substr($array[20], 0, 9) / 100) * $signo);
                
                if($array[21][9] == '}') {
                    $signo = -1;
                } else {
                    $signo = 1;
                }
                $array[21] = ((substr($array[21], 0, 9) / 100) * $signo);
                
                $array[41] = trim($array[41]);
                $array[42] = trim($array[42]);
                
                $update = array(
                    'organization_id' => 1,
                    'category_id' => $array[2],
                    'order_number' => $array[3],
                    'rack' => $array[4],
                    'price' => $array[6],
                    'price_fob' => $array[9],
                    'price_dispatch' => $array[11],
                    'stock2' => $array[19],
                    'stock' => $array[20],
                    'stock_pending' => $array[21],
                    'stock_min' => $array[13],
                    'stock_max' => $array[14],
                    'observations' => $array[41],
                    'description' => $array[42]
                );
                
                if(count($resultado) > 0) {
                    $this->productos_model->update($update, $resultado['product_id']);
                } else {
                    $update['code'] = trim($array[0]);
                    $update['brand_id'] = $array[1];
                    $this->productos_model->set_product($update);
                }
                /*
                echo "<PRE>";
                print_r($array);
                print_r($resultado);
                print_r(count($resultado));
                print_r($update);
                //$this->productos_model->update($update, $resultado['product_id']);
                echo "</PRE>";*/
            //}
        }
        fclose($fp);
        
        var_dump($count);
        
        $this->benchmark->mark('fin');
        
        echo $this->benchmark->elapsed_time('inicio', 'fin');
    }
    
    public function vencimientos_impuestos_afip() {
        $json = file_get_contents("https://soa.afip.gob.ar/parametros/v1/impuestos/");
        $data = json_decode($json);
        $this->vencimientos_impuestos_model->truncate();
        
        echo "<pre>";
        foreach($data->data as $impuesto) {
            $array = array(
                'idimpuesto' => $impuesto->idImpuesto,
                'impuesto' => $impuesto->descImpuesto
            );
            $this->vencimientos_impuestos_model->set($array);
            print_r($array);
//            print_r($impuesto->idImpuesto);
//            print_r($impuesto->descImpuesto);
        }
        echo "</pre>";
    }
    
    public function vencimientos_conceptos_afip() {
        $json = file_get_contents("https://soa.afip.gob.ar/parametros/v1/conceptos/");
        $data = json_decode($json);
        $this->vencimientos_conceptos_model->truncate();
        
        echo "<pre>";
        foreach($data->data as $concepto) {
            $array = array(
                'idconcepto' => $concepto->idConcepto,
                'concepto' => $concepto->descConcepto
            );
            $this->vencimientos_conceptos_model->set($array);
            print_r($array);
//            print_r($impuesto->idImpuesto);
//            print_r($impuesto->descImpuesto);
        }
        echo "</pre>";
    }
}

?>