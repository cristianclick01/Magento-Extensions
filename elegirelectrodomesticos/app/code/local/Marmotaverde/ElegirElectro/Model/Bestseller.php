<?php

Class Marmotaverde_ElegirElectro_Model_Bestseller extends Mage_Core_Model_Abstract{
    
    private $products;
    private $storeId;
    
    public function masVendidos(){
        $this->storeId    = Mage::app()->getStore()->getId();
        $this->products = Mage::getResourceModel('reports/product_collection')
                      ->addOrderedQty()
                      ->addAttributeToSelect('*') //edit to suit tastes
                      ->setStoreId($this->storeId)
                      ->addStoreFilter($this->storeId)
                      ->setOrder('ordered_qty', 'desc'); //best sellers on top
                      
         Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($this->products);
         Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($this->products);
         
         return $this->products;
  }

}



?>