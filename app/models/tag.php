<?php
class Tag extends AppModel {
	var $name = 'Tag';
	var $displayField = 'name';
	var $actsAs = array('Search.Searchable');
		
	//var paginate = array('fields'=>array('DISTINCT Tag.name'));
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
		'Tagged' => array(
			'className' => 'Tagged',
			'foreignKey' => 'tag_id',
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
}
