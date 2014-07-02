<?php

class Marmotaverde_ElegirElectro_Model_Secadora extends Mage_Core_Model_Abstract{
    
    private $energia;
    private $sistema;
    private $productos;
    
    public function _construct () 
    { 
       parent::_construct(); 
       $this-> _init('elegirelectro/secadora'); 
    }
    
    public function getSecadora(){
        return Mage::getModel('catalog/category')->load(60)
                            ->getProductCollection()
                            ->addAttributeToSelect('*') // add all attributes - optional
                            ->addAttributeToFilter('status', 1) // enabled
                            ->setOrder('price', 'ASC'); //sets the order by price
    }
    
    public function elegirEnergia($energia){
        
        $this->productos = $this->getSecadora();
        
        if ($energia == '1'){
            foreach ($this->productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'A+++')
                    $energia_p[] = $_product;
            }
        }
        elseif ($energia == '2'){
            foreach ($this->productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'A++' || $this->energia == 'A+' || $this->energia == 'A' || $this->energia == 'B')
                    $energia_p[] = $_product;
            }
        }
        else{
            foreach ($this->productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'C' || $this->energia == 'D')
                    $energia_p[] = $_product;
            }
        }

        return $energia_p;
    }
    
    public function tipoSecadora($productos, $tipo_sec){
        
        if ($tipo_sec == 'true'){
            foreach ($productos as $_product){
                $this->sistema = $_product->getResource()->getAttribute('sist_secado')->getFrontend()->getValue($_product);
                if ($this->sistema == 'Evacuación')
                    $secado_p[] = $_product;
            }
        }
        else{
            foreach ($productos as $_product){
                $this->sistema = $_product->getResource()->getAttribute('sist_secado')->getFrontend()->getValue($_product);
                if ($this->sistema == 'Condensación')
                    $secado_p[] = $_product;
            }
        }
        return $secado_p;
    }
    
    
    
    
    
    
    public function elimina_duplicados($array, $campo){
        foreach ($array as $sub){
            $cmp[] = $sub[$campo];
        }
        
        $unique = array_unique($cmp);
        foreach ($unique as $k => $campo){
            $resultado[] = $array[$k];
        }
        
        return $resultado;
    }

}