<?php

class Marmotaverde_ElegirElectro_Model_Lavadora extends Mage_Core_Model_Abstract{
    
    private $tipo;
    private $carga;
    private $rpm;
    private $energia;
    private $productos;
    
    public function _construct () 
    { 
       parent::_construct(); 
       $this-> _init('elegirelectro/lavadora'); 
    }
    
    
    private function getLavadoras(){
        return Mage::getModel('catalog/category')->load($this->tipo)
                            ->getProductCollection()
                            ->addAttributeToSelect('*') 
                            ->addAttributeToFilter('status', 1) //hablitados
                            ->setOrder('price', 'ASC');  //orden ascendente por precio o cualquier atributo... a elegir
    }
    
    public function elegirTipoLavadora($tipo){
        if ($tipo == '1')
            $this->tipo = 50; //carga frontal id cat
        elseif ($tipo == '2')
            $this->tipo = 56; //carga superior id cat
        else
            $this->tipo = 57; //integrables id cat
        
        $productos = $this->getLavadoras();
        return $productos;
    }
    
    public function elegirCargaLavadora($productos, $casa){
        
        if ($casa == '1'){
            foreach ($productos as $_product){
                $this->carga = $_product->getResource()->getAttribute('carga_lavado')->getFrontend()->getValue($_product);
                if ($this->carga == '5 Kg' || $this->carga == '6 Kg'){
                    $productos_kg[] = $_product;
                }
            }
        }
        elseif ($casa == '2'){
            foreach ($productos as $_product){
                $this->carga = $_product->getResource()->getAttribute('carga_lavado')->getFrontend()->getValue($_product);
                if ($this->carga == '7 Kg'){
                    $productos_kg[] = $_product;
                }
            }
        }
        elseif ($casa == '3'){
            foreach ($productos as $_product){
                $this->carga = $_product->getResource()->getAttribute('carga_lavado')->getFrontend()->getValue($_product);
                if ($this->carga == '8 Kg'){
                    $productos_kg[] = $_product;
                }
            }
        }
        elseif ($casa == '4'){
            foreach ($productos as $_product){
                $this->carga = $_product->getResource()->getAttribute('carga_lavado')->getFrontend()->getValue($_product);
                if ($this->carga == '9 Kg' || $this->carga == '10 Kg' || $this->carga == '11 Kg' || $this->carga == '12 Kg' || $this->carga == '13 Kg'){
                    $productos_kg[] = $_product;
                }
            }
        }
        
        return $productos_kg;
    }
    
    public function elegirCentrifugado($productos, $secadora){
        
        if ($secadora == '1'){
            foreach ($productos as $_product){
                $this->rpm = $_product->getResource()->getAttribute('centrifugado')->getFrontend()->getValue($_product);
                if ($this->rpm == '1100 rpm' || $this->rpm == '1200 rpm' || $this->rpm == '1300 rpm' || $this->rpm == '1400 rpm' || $this->rpm == '1500 rpm' || $this->rpm == '1600 rpm'){
                    $productos_rpm[] = $_product;
                }
            }
        }
        elseif ($secadora == '2'){
            foreach ($productos as $_product){
                $this->rpm = $_product->getResource()->getAttribute('centrifugado')->getFrontend()->getValue($_product);
                if ($this->rpm == '1000 rpm' || $this->rpm == '900 rpm' || $this->rpm == '800 rpm' || $this->rpm == '700 rpm' || $this->rpm == '600 rpm'){
                    $productos_rpm[] = $_product;
                }
            }
        }
        
        return $productos_rpm;
        
    }
    
    
    public function elegirEnergia($productos, $nuevo){
        
        if ($nuevo == '1'){
            foreach ($productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'A+++' || $this->energia == 'A++')
                    $productos_en[] = $_product;
            }
        }
        elseif ($nuevo == '2'){
            foreach ($productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'A++')
                    $productos_en[] = $_product;
            }
        }
        elseif ($nuevo == '3'){
            foreach ($productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'A+')
                    $productos_en[] = $_product;
            }
        }
        elseif ($nuevo == '3'){
            foreach ($productos as $_product){
                $this->energia = $_product->getResource()->getAttribute('energia')->getFrontend()->getValue($_product);
                if ($this->energia == 'A+' || $this->energia == 'A')
                    $productos_en[] = $_product;
            }
        }
        
        return $productos_en;
    }
    
    
    public function hayOfertas($products){
        foreach ($products as $_product){
            $specialprice = Mage::getModel('catalog/product')->load($_product->getId())->getSpecialPrice(); 
            $specialPriceFromDate = Mage::getModel('catalog/product')->load($_product->getId())->getSpecialFromDate();
            $specialPriceToDate = Mage::getModel('catalog/product')->load($_product->getId())->getSpecialToDate();
            $today =  time();
            
            if ($specialprice)
                if($today >= strtotime( $specialPriceFromDate) && $today <= strtotime($specialPriceToDate) || $today >= strtotime( $specialPriceFromDate) && is_null($specialPriceToDate))
                    $producto_oferta[] = $_product;
        }
        
        if ($producto_oferta)
            return $producto_oferta;
        else
            return $products;
    }


}