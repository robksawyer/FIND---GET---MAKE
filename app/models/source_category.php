<?php
class SourceCategory extends AppModel {
	var $name = 'SourceCategory';
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
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'source_category_id',
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
	 * This method keeps the category from being deleted if there are sources inside.
	 * @param 
	 * @return 
	 * 
	*/
	function beforeDelete(){
		$count = $this->Source->find("count", array(
													"conditions" => array(
																		"source_category_id" => $this->id
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
