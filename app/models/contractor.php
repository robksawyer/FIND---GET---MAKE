<?php
App::Import('Sanitize');
class Contractor extends AppModel {
	var $name = 'Contractor';
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
		'ContractorSpecialty' => array(
			'className' => 'ContractorSpecialty',
			'foreignKey' => 'contractor_specialty_id',
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
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'Contractor'),
			'dependent' => true,
			'exclusive' => true
		)
	);

	var $hasAndBelongsToMany = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'joinTable' => 'attachments_contractors',
			'foreignKey' => 'contractor_id',
			'associationForeignKey' => 'attachment_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'joinTable' => 'contractors_sources',
			'foreignKey' => 'contractor_id',
			'associationForeignKey' => 'source_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
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