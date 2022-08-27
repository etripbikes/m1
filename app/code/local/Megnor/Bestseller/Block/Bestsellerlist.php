<?php

class Megnor_Bestseller_Block_Bestsellerlist extends Mage_Catalog_Block_Product_Abstract
{
	 /**
     * Retrive Bestselling product
     *
     * @param   
     * @Return Mage_Catalog_Block_Product_Bestseller
     */ 	 
	 
	public function _prepareLayout() 
	{
		
		 if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbsBlock->addCrumb('home', array(
                    'label'=>Mage::helper('catalog')->__('Home'),
                    'title'=>Mage::helper('catalog')->__('Go to Home Page'),
                    'link'=>Mage::getBaseUrl()
                ));
        }    

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
						->setStoreId($storeId)
						->addAttributeToFilter('type_id', array('eq' => 'simple'))
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
		                      

		
		
		$this->setToolbar($this->getLayout()->createBlock('catalog/product_list_toolbar', 'Toolbar'));
		$toolbar = $this->getToolbar();
	
		$limit = (int)$this->getLimit();
	
	    if ($limit) {
	        $products->setPageSize($limit);
	    }
	    if ($this->getCurrentOrder()) {
	        $products->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
	    }
			
	    $pager = $this->getLayout()->createBlock('page/html_pager', 'Pager');
	
	    $pager->setCollection($products);
	
	    $toolbar->setChild('product_list_toolbar_pager', $pager);

		$toolbar->setAvailableOrders(array(
		'ordered_qty'  => $this->__('Most Purchased'),
		'name'      => $this->__('Name'),
		'price'     => $this->__('Price')
		
			))
		->setDefaultOrder('ordered_qty')
		->setDefaultDirection('desc')
		->setCollection($products);
		
		return $this;
	}


	/**
     * Retrive Bestselling product collection
     *
     * @param   
     * @Return Mage_Reports_Model_Mysql4_Product_Collection
     */ 
	protected function _getProductCollection() {
		return $this->getToolbar()->getCollection();
	}

	/**
     * Retrive Toolbar
     *
     * @param   
     * @Return String (HTML for Toolbar)
     */ 
	public function getToolbarHtml() {
		return $this->getToolbar()->_toHtml();
	}

	/**
     * Retrive Mode
     *
     * @param   
     * @Return String (grid || list)
     */ 
	public function getMode() {
		return $this->getToolbar()->getCurrentMode();
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
	
	public function getAllCategory()
	{				
		return Mage::helper('catalog/category')->getStoreCategories('name', true, false);		
	}
	
	public function getParentId($product)
	{
		$parentId = '';
				
		// if the product visibility is not set to "Nowhere"
		// i.e. if the product is visible
		if($product->getVisibility() != '1') {
			$parentId = $product->getId(); 
		}		
		else {
			// get parent id if the product is not visible
			// this means that the product is associated with a configurable product
			$parentIdArray = $product->loadParentProductIds()->getData('parent_product_ids');
			
			if(!empty($parentIdArray)) {
				$parentId = $parentIdArray[0];
			}
		}		
		return $parentId; 
	}
	
	protected function _toHtml() {
        if (!$this->helper('bestseller')->getIsActive()) {
            return '';
        }
        return parent::_toHtml();
    }
	
	public function getPageHeading() {		
		return  Mage::getStoreConfig('bestseller/standalone/heading');		
    }
	
	public function getHeading() {		
		return  Mage::getStoreConfig('bestseller/listing_home/heading');		
    } 

} 


