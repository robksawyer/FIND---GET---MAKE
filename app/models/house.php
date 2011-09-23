<?php
App::Import('Sanitize');
class House extends AppModel {
	var $name = 'House';
	var $displayField = 'name';
	
	var $validate = array(
		'name' => array(
			'rule'=>array('minLength', 1), 
			'message'=>'Name is required' )
	);
	
	var $actsAs = array(
					'Tags.Taggable',
					'Search.Searchable'
					);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'model_id',
			'conditions' => array('Attachment.model' => 'House'),
			'dependent' => true,
			'exclusive' => true
		),
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'House'),
			'dependent' => true,
			'exclusive' => true
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
}