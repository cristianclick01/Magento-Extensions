<?php
class Marmotaverde_ElegirElectro_Block_Formulario extends Mage_Core_Block_Template
{
        
     public function getFormulario()
     {
          $resource = Mage::getSingleton('core/resource');
          $read= $resource->getConnection('core_read');
          $tabla = $resource->getTableName('directory_country_city');
          
          $query = $read->select()->from('directory_country_city', 'default_name')->limit(10);
          
          // Listado
          $datos = $read->fetchAll($query);
         
         return $datos;
     }
}

?>