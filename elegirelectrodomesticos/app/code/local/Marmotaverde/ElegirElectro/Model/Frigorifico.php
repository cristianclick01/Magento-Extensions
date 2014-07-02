<?php

class Marmotaverde_ElegirElectro_Model_Frigorifico extends Mage_Core_Model_Abstract{
    
    private $altura; //contiene el valor del id de magento
    private $eficiencia;
    private $frio;
    private $color;
    private $coleccion;
    
    public function _construct () 
    { 
       parent::_construct(); 
       $this-> _init('elegirelectro/frigorifico'); 
    }
    
    public function elegirTipoFrigorifico($personas){ //2puertas o combi de 1.85 o 2
        if ($personas == '1')
            $this->altura = 28;
        elseif ($personas == '2')
            $this->altura = 33;
        elseif ($personas == '3')
            $this->altura = 34;
        

        $this->coleccion = $this->getFrigorifico();
        return $this->coleccion;
    }
    
    public function getFrigorifico(){
        return Mage::getModel('catalog/category')->load($this->altura)
                            ->getProductCollection()
                            ->addAttributeToSelect('*') // add all attributes - optional
                            ->addAttributeToFilter('status', 1) // enabled
                            ->setOrder('price', 'ASC'); //sets the order by price
    }
    
    public function elegirtipoDeFrio($productos, $personas, $congelado){
        
        if ($personas == 1 && $congelado == 'true'){ //si son 1 o 2personas y si utilizan producto congelado - COMBI 1,85 Y NOFROST
            $this->altura = 33;
            //$this->frio = 1;
            $productos = $this->getFrigorifico();
            return $productos;
        }
        elseif ($personas == 2 || $personas == 3 && $congelado == 'true'){
            $nofrost = array();
            foreach ($productos as $_product){
                $this->frio = $_product->getResource()->getAttribute('sist_frio')->getFrontend()->getValue($_product);
                if ($this->frio == 'No Frost')
                    $nofrost[] = $_product;
            }
            return $nofrost;
        }
        
        return $productos;
    }
    
    public function elegirColor($diseno, $productos){
        $acabado = array();
        
        
        if ($diseno == 'true'){
            foreach ($productos as $_product){
                $this->color = $_product->getResource()->getAttribute('acabado')->getFrontend()->getValue($_product);
                if ($this->color != 'Blanco' && $this->color != 'No'){
                    $acabado[] = $_product;
                }
            }
            return $acabado;
            
        } else {
            foreach ($productos as $_product){
                $this->color = $_product->getResource()->getAttribute('acabado')->getFrontend()->getValue($_product);
                if ($this->color == 'Blanco' && $this->color != 'No')
                    $acabado[] = $_product;
            }
            return $acabado;
        }
    }
    
    public function elegirClaseEnergetica($productos, $eco){
        $eco_productos = array();
       
        if ($eco == '1'){
            foreach ($productos as $_product){
                $this->eficiencia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->eficiencia == 'A+++' || $this->eficiencia == 'A++')
                    $eco_productos[] = $_product;
            }
        }elseif ($eco == '2'){
            foreach ($productos as $_product){
                $this->eficiencia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->eficiencia == 'A+++' || $this->eficiencia == 'A++')
                    $eco_productos[] = $_product;
            }
        }else{
            foreach ($productos as $_product){
                $this->eficiencia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->eficiencia == 'A+' || $this->eficiencia == 'A')
                    $eco_productos[] = $_product;
            }
        }
        return $eco_productos;

    }

}