<?php

class Megnor_Bestseller_Block_Bestseller extends Mage_Catalog_Block_Product_Abstract
{
	 /**
     * Retrive Bestselling product
     *
     * @param   
     * @Return Mage_Catalog_Block_Product_Bestseller
     */ 	 
	 
	public function getCollection() 
	{
		
		

		$storeId = Mage::app()->getStore()->getId();

		
        			$productssample = Mage::getResourceModel('reports/product_collection')
						->addOrderedQty()
						->addUrlRewrite()
						->setStoreId($storeId)
						->addStoreFilter($storeId)
						->setPageSize($this->getProductsCount())	
						->setOrder('ordered_qty', 'desc'); 
					$visibility = array(
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
                 		 );
	
	
					if ($productssample->isEnabledFlat())
					{
					
						$products = Mage::getResourceModel('reports/product_collection')
						->addOrderedQty()
						->addUrlRewrite()
						->addAttributeToFilter('type_id', array('eq' => 'simple'))
						->setStoreId($storeId)
						->addStoreFilter($storeId)
						->setPageSize($this->getProductsCount())
						->setOrder('ordered_qty', 'desc'); 
					
						$products->getSelect()->joinLeft(
						array('flat' => 'catalog_product_flat_'.$storeId),
						"(e.entity_id = flat.entity_id ) ",array('flat.name AS name','flat.small_image AS small_image','flat.price AS price')
						);
					} else{
					
						
						$products = Mage::getResourceModel('reports/product_collection')
                              ->addAttributeToSelect('*')
                              ->addOrderedQty()
                              ->addAttributeToFilter('visibility', $visibility)
							  ->setPageSize($this->getProductsCount())	
							  ->setOrder('ordered_qty', 'desc'); 
					
					}
		                      

		
	
		return $products;
	}


	
	protected function _getProductCollection() {
		return $this->getCollection();
	}

	
	/**
     * Retrive Loaded product Collection
     *
     * @param   
     * @Return Mage_Reports_Model_Mysql4_Product_Collection
     */ 
	public function getLoadedProductCollection() {
		return $this->_getProductCollection();
	}
	
	
	protected function _toHtml() {
        if (!$this->helper('bestseller')->getIsActive()) {
            return '';
        }
        return parent::_toHtml();
    }
	
	public function setProductsCount($count) {
        $this->_productsCount = $count;
        return $this;
    }

    public function getProductsCount() {		
		$count = Mage::getStoreConfig('bestseller/sidebar/number_of_items');
				
		if($count) 		
			return $count;
			
        if (null === $this->_productsCount) {
            $this->_productsCount = self::DEFAULT_PRODUCTS_COUNT;
        }
        return $this->_productsCount;
    }
	
	public function getSidebarHeading() {		
		return Mage::getStoreConfig('bestseller/sidebar/heading');		
    }

} 


