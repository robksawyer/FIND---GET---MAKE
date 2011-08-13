<?php
class Tagged extends AppModel {
	var $name = 'Tagged';
	var $useTable = 'tagged';
	
	//var paginate = array('fields'=>array('DISTINCT Tag.name'));
		
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>