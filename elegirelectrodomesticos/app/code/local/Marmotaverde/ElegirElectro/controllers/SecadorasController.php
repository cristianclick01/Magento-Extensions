<?php
class Marmotaverde_ElegirElectro_SecadorasController extends Mage_Core_Controller_Front_Action
{
    private $productos = array();
    
     public function indexAction()
     {
          $this->loadLayout();   //RECUPERAMOS EL LAYOUT
          $this->getLayout()->getBlock('head')->setTitle($this->__('Elegimos tu secadora ideal'));  //Para cambiar el titulo
          $this->renderLayout();
     }
     
	 
     public function guardarAction(){
         $salida = $this->getRequest()->getPost('salida');
         $uso = $this->getRequest()->getPost('uso');
         $eco = $this->getRequest()->getPost('eco');
         
         $m_secadora = Mage::getModel('elegirelectro/secadora');
         $collection = $m_secadora->elegirEnergia($eco);
         $collection = $m_secadora->tipoSecadora($collection, $salida);
         
         if ($collection){
            $modeloFunciones = Mage::getModel('elegirelectro/functions');
            echo $modeloFunciones->drawProduct($collection);
         }
         else
             echo '1';

     }
}

?>