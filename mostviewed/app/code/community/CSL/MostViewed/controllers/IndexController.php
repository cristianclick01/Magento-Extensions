<?php
class CSL_MostViewed_IndexController extends Mage_Core_Controller_Front_Action
{
    
     public function indexAction()
     {
          $this->loadLayout();   //RECUPERAMOS EL LAYOUT
          $this->getLayout()->getBlock('head')->setTitle($this->__('List of 10 Most viewed products'));  //Para cambiar el titulo
          $this->renderLayout();
     }
	 
     
}

?>