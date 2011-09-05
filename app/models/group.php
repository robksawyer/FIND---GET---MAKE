<?php
class Group extends AppModel {
	var $name = 'Group';
	var $displayField = 'name';
	
	var $actsAs = array('Acl'=>array('type'=>'requester'));
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
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
	 * The AclBehavior allows for the automagic connection of models with the Acl tables. 
	 * Its use requires an implementation of parentNode() on your model.
	 * @param 
	 * @return 
	 * 
	*/
	function parentNode() {
		return null;
	}

}