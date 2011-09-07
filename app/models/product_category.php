<?php
App::Import('Sanitize');
class ProductCategory extends AppModel {
	var $name = 'ProductCategory';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	/**
	 * Sanitize all data saved
	 * @param 
	 * @return 
	 * 
	*/
	var $cleanData = true;
	
	/**
	 * Runs before every save event in the system
	 * @param 
	 * @return 
	 * 
	*/
	public function beforeSave(){
		//Sanitize the data added to the database
		if (!empty($this->data) && $this->cleanData === true) {
			$this->data = Sanitize::clean($this->data, array('escape' => false,'remove_html' => true));
		}
		return true;
	}
	
	/**
	 * This method keeps the category from being deleted if there are products inside.
	 * @param 
	 * @return 
	 * 
	*/
	function beforeDelete(){
		$count = $this->Product->find("count", array(
													"conditions" => array(
																		"product_category_id" => $this->id
																		)
																	));
		if ($count == 0) {
			return true;
		} else {
			return false;
		}
	}
	
	/** 
	 * Returns all of the categories in the system
	 * @param 
	 */
	function getList(){
		$this->recursive = 1;
		$categories = $this->find('list',array('order' => 'name ASC'));
		return $categories;
	}
	
	/** 
	 * Returns all of the categories in the system
	 * @param 
	 */
	function getAll($more=false){
		$this->recursive = -1;
		if($more){
			$categories = $this->find('all',array('order' => 'name ASC',
												'contain'=>array('Product'=>array('Attachment','User','Tag'))
												));
		}else{
			$categories = $this->find('all',array('order' => 'name ASC'));
		}
		//debug($categories);
		return $categories;
	}

}