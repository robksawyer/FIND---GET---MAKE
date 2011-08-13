<?php
class InspirationPhotoTag extends AppModel {
	var $name = 'InspirationPhotoTag';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'attachment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'foreignKey' => 'inspiration_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * 
	 * @param id The id of the item being updated.
	 * @param model The model to search for the inspiration photo tag in
	 * @param name The new name of the item 
	 * @return 
	 * 
	*/
	function updateName($id=null,$model=null,$name=null){
		$item = $this->$model->findById($id);
		if(!empty($item['InspirationPhotoTag'])){
			foreach($item['InspirationPhotoTag'] as $photo_tag){
				$this->id = $photo_tag['id'];
				$this->saveField('name', $name);
			}
		}
	}
}
