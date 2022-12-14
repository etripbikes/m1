<?php class Megnor_Newproducts_Block_Newproductslist extends Mage_Catalog_Block_Product_Abstract{  
	  protected $_productsCount = null;    
	  const DEFAULT_PRODUCTS_COUNT = 5;		
	  protected function _prepareLayout() {		
	  			if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {        	
						$breadcrumbsBlock->addCrumb('home', array(            
						'label'=>Mage::helper('catalog')->__('Home'),            
						'title'=>Mage::helper('catalog')->__('Go to Home Page'),            
						'link'=>Mage::getBaseUrl()   
					     ));    
				    }                                   
					
				parent::_prepareLayout();   
		} 
				 
		protected function _beforeToHtml() {
		
		            $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT); 
					$collection = Mage::getResourceModel('catalog/product_collection');        
					Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);        
					Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);                
					$collection = $this->_addProductAttributesAndPrices($collection)           
						 ->addStoreFilter()			
						 ->addAttributeToSelect(array('name', 'price', 'thumbnail', 'short_description','image','small_image','url_key'), 'inner')            
						 ->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate))            
						 ->addAttributeToFilter('news_to_date', array('or'=> array(                
						 			0 => array('date' => true, 'from' => $todayDate),               
									1 => array('is' => new Zend_Db_Expr('null')))           
									 ), 'left')            
						->addAttributeToSort('news_from_date', 'desc')            
						->setPageSize($this->getProductsCount())			           
						 ->setCurPage(1);				
					
					
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
					
						$pager->setCollection($collection);
					
						$toolbar->setChild('product_list_toolbar_pager', $pager);
										
						 
						 $toolbar->setDefaultOrder('news_from_date')		
						 ->setDefaultDirection('desc')		
						 ->setCollection($collection);				
						 return $this;           
		
		
		

		
		
		
		
		
		
		}		
		
		protected function _toHtml() {        
			if (!(bool) Mage::getStoreConfig('newproducts/general/active')) { 
			 return ''; 
			}      
		 return parent::_toHtml();    
	   }    
	   
	   public function setProductsCount($count) {        
	   		$this->_productsCount = $count;        
			return $this;    
		}    
		
		public function getProductsCount(){
			if (null === $this->_productsCount) { 
				 $this->_productsCount = self::DEFAULT_PRODUCTS_COUNT;
				 } 
		 return $this->_productsCount;   
		 }		
		 
		 public function getToolbarHtml() {
		 	return $this->getToolbar()->_toHtml();
		}		
		
		public function getMode() {	
			return $this->getToolbar()->getCurrentMode();	
		}		
		
		public function getProductCollection() {
			return $this->getToolbar()->getCollection();
		}
		
		public function getHeading() {
			return Mage::getStoreConfig('newproducts/listing_home/heading'); 
		}	
		
		public function getPageHeading() {
			return Mage::getStoreConfig('newproducts/standalone/heading');
		}	
		
}