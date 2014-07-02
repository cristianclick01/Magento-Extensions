<?php

class Marmotaverde_ElegirElectro_Model_Functions extends Mage_Core_Model_Abstract{
    
    private function elimina_duplicados($array, $campo){
        foreach ($array as $sub){
            $cmp[] = $sub[$campo];
        }
        
        $unique = array_unique($cmp);
        foreach ($unique as $k => $campo){
            $resultado[] = $array[$k];
        }
        
        return $resultado;
    }
    
     //dibujamos el producto seleccionado
     public function drawProduct($productos){
         $i = 0;
         foreach ($productos as $p){
            $rnd = rand(0, count($productos) -1);
            $info[] = array('nombre' => $p->getName(), 'precio' => number_format($p->getFinalPrice(), 2), 'des_corta' => $p->getShortDescription(), 'sku' => $p->getSku(), 'image' => $p->getImageUrl() , 'id' => $p->getId(), 'url' => $p->getProductUrl());
            $i++;
            if ($i == 3)
                break;
         }
         
         //eliminamos los elementos duplicados antes de dibujar productos
         $info = $this->elimina_duplicados($info, 'id');
         return json_encode($info);
     }
    
}
