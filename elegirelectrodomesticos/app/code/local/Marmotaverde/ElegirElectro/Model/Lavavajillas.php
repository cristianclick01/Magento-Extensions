<?php

class Marmotaverde_ElegirElectro_Model_Lavavajillas extends Mage_Core_Model_Abstract{
    
    private $tipo;
    private $color;
    private $clase;
    
    public function _construct () 
    { 
       parent::_construct(); 
       $this-> _init('elegirelectro/lavavajillas'); 
    }
    
    
    private function getLavavajillas(){
        return Mage::getModel('catalog/category')->load($this->tipo)
                            ->getProductCollection()
                            ->addAttributeToSelect('*') 
                            ->addAttributeToFilter('status', 1) //hablitados
                            ->setOrder('price', 'ASC');  //orden ascendente por precio o cualquier atributo... a elegir
    }
    
    public function elegirTipoLavavajillas($tipo){
        if ($tipo == '1')
            $this->tipo = 65;
        else
            $this->tipo = 69;
        
        return $this->tipo;
    }
    
    public function elegirAnchoLavavajillas($tipo, $ancho){
        
        if ($tipo == 69 && $ancho == '1')
            $this->tipo = 66;
        elseif ($tipo == 69 && $ancho == '2')
            $this->tipo = 67;
        elseif ($tipo == 69 && $ancho == '3')
            $this->tipo = 68;
        elseif ($tipo == 65 && $ancho == '1')
            $this->tipo = 70;
        elseif ($tipo == 65 && $ancho == '2')
            $this->tipo = 71;
        elseif ($tipo == 65 && $ancho == '2')
            $this->tipo = 72;
                
        $productos = $this->getLavavajillas();
        return $productos;
    }
    
    public function elegirColorLavavajillas($color, $_product){

        if ($color == '1')
            $productos = $this->verColor('Blanco', $_product);
        elseif ($color == '2')
            $productos = $this->verColor('Acero Inox', $_product);
        elseif ($color == '3')
            $productos = $this->verColor('Negro', $_product);

        return $productos;
    }
    
    public function elegirClaseEnergetica($clase, $_product){
        
        if ($clase == '1')
            $productos = $this->verClase('A+++', $_product);
        elseif ($clase == '2')
            $productos = $this->verClase('A++', $_product);
        elseif ($clase == '3')
            $productos = $this->verClase('A+', $_product);
        
        return $productos;
    }
    
    
    private function verColor($color, $_product){
        foreach ($_product as $p){
            $this->color = $p->getResource()->getAttribute('acabado')->getFrontend()->getValue($p);
            if ($this->color == $color)
                $productos[] = $p;
        }
        
        return $productos;
    }
    
    private function verClase($clase, $_product){
        foreach ($_product as $p){
            $this->clase = $p->getResource()->getAttribute('energia')->getFrontend()->getValue($p);
            if ($this->clase == $clase)
                $productos[] = $p;
        }
        
        return $productos;
    }
    
}

?>