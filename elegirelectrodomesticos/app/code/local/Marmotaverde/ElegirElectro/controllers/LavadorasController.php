<?php
class Marmotaverde_ElegirElectro_LavadorasController extends Mage_Core_Controller_Front_Action
{   
     public function indexAction()
     {
          $this->loadLayout();   //RECUPERAMOS EL LAYOUT
          $this->getLayout()->getBlock('head')->setTitle($this->__('Elegimos tu lavadora ideal'));  //Para cambiar el titulo
          $this->renderLayout();
     }
     
	 
     public function guardarAction(){
         $lava = $this->getRequest()->getPost('lava');
         $casa = $this->getRequest()->getPost('casa');
         $secadora = $this->getRequest()->getPost('secadora');
         $nuevo = $this->getRequest()->getPost('nuevo');
         $eco = $this->getRequest()->getPost('eco');
         
         $modeloLavadoras = Mage::getModel('elegirelectro/lavadora');
         $collection = $modeloLavadoras->elegirTipoLavadora($lava);
         $collection = $modeloLavadoras->elegirCargaLavadora($collection, $casa);
         $collection = $modeloLavadoras->elegirCentrifugado($collection, $secadora);
         $collection = $modeloLavadoras->elegirEnergia($collection, $nuevo);
         if ($eco == '1')
             $collection = $modeloLavadoras->hayOfertas($collection);
         
         if ($collection){
            $modeloFunciones = Mage::getModel('elegirelectro/functions');
            echo $modeloFunciones->drawProduct($collection);
         }
         else
             echo '1';
         
     }

}


?>