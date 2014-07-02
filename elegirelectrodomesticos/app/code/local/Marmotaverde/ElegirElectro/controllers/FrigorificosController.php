<?php

class Marmotaverde_ElegirElectro_FrigorificosController extends Mage_Core_Controller_Front_Action
{    
     public function indexAction()
     {
          $this->loadLayout();   //RECUPERAMOS EL LAYOUT
          $this->getLayout()->getBlock('head')->setTitle($this->__('Elegimos tu frigor&iacute;fico ideal'));  //Para cambiar el titulo
          $this->renderLayout();
     }
     
	 
     public function guardarAction(){
         
         //RECUPERAMOS
         $casa = $this->getRequest()->getPost('casa');
         $congelado = $this->getRequest()->getPost('congelado');
         $diseno = $this->getRequest()->getPost('diseno');
         $zona = $this->getRequest()->getPost('zona');
         $eco = $this->getRequest()->getPost('eco');
         
         //CARGAMOS
         $m_frigo = Mage::getModel('elegirelectro/frigorifico');
         $collection = $m_frigo->elegirTipoFrigorifico($casa);
         $collection = $m_frigo->elegirtipoDeFrio($collection, $casa, $congelado);
         $collection = $m_frigo->elegirColor($diseno, $collection);
         $collection = $m_frigo->elegirClaseEnergetica($collection, $eco);
         
         //DIBUJAMOS
         $html = Mage::getModel('elegirelectro/functions')->drawProduct($collection);
         echo $html;
     }
}

?>