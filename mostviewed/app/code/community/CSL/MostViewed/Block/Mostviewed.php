<?php
class CSL_MostViewed_Block_Mostviewed extends Mage_Catalog_Block_Product_List
{
        public function getProducts(){
			
			$product_count = 10;
			$storeId = Mage::app()->getStore()->getId();      
			$products = Mage::getResourceModel('reports/product_collection')
				->addAttributeToSelect('*')     
				->setStoreId($storeId)
				->addStoreFilter($storeId)
				->addAttributeToSelect(array('name', 'price', 'minimal_price', 'small_image')) 
				->addViewsCount()
				->setPageSize($product_count);

			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($products);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($products);

			return $products;
		}
}

?>