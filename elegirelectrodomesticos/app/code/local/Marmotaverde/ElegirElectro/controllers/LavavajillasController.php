<?php
class Marmotaverde_ElegirElectro_LavavajillasController extends Mage_Core_Controller_Front_Action {
     
    
    public function indexAction(){
          $this->loadLayout();   //RECUPERAMOS EL LAYOUT
          $this->getLayout()->getBlock('head')->setTitle($this->__('Elegimos tu lavavajillas ideal'));  //Para cambiar el titulo
          $this->renderLayout();
     }
     
    public function guardarAction(){
         $vista = $this->getRequest()->getPost('vista');
         $ancho = $this->getRequest()->getPost('ancho');
         $diseno = $this->getRequest()->getPost('diseno');
         $eco = $this->getRequest()->getPost('eco');
         
         $lavavajillas = Mage::getModel('elegirelectro/lavavajillas');
         $tipo = $lavavajillas->elegirTipoLavavajillas($vista);
         $collection = $lavavajillas->elegirAnchoLavavajillas($tipo, $ancho);
         if ($diseno != '4') //solo modelos integrables elegiran color.
            $collection = $lavavajillas->elegirColorLavavajillas($diseno, $collection);
         
         $collection = $lavavajillas->elegirClaseEnergetica($eco, $collection);
         
         if ($collection){
            $modeloFunciones = Mage::getModel('elegirelectro/functions');
            echo $modeloFunciones->drawProduct($collection);
         }
         else
             echo '1';

    }

}

?>