<?php
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
	 * Returns all of the categories in the system
	 * @param 
	 */
	function getList(){
		$categories = $this->find('list',array('order' => 'name ASC'));
		return $categories;
	}
	
	/** 
	 * Returns all of the categories in the system
	 * @param 
	 */
	function getAll(){
		$categories = $this->find('all',array('order' => 'name ASC'));
		return $categories;
	}

}
