<?php
class Marmotaverde_ElegirElectro_IndexController extends Mage_Core_Controller_Front_Action
{
    
     public function indexAction()
     {
          $this->loadLayout();   //RECUPERAMOS EL LAYOUT
          $this->getLayout()->getBlock('head')->setTitle($this->__('Clic para empezar con la selecci&oacute;n de electrodom&eacute;sicos'));  //Para cambiar el titulo
          $this->renderLayout();
     }
	 
     
}

?>