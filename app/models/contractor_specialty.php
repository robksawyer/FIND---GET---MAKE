<?php
App::Import('Sanitize');
class ContractorSpecialty extends AppModel {
	var $name = 'ContractorSpecialty';
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
		'Contractor' => array(
			'className' => 'Contractor',
			'foreignKey' => 'contractor_specialty_id',
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
	 * This method keeps a specialty from being deleted if there are contractors inside.
	 * @param 
	 * @return 
	 * 
	*/
	function beforeDelete(){
		$count = $this->Contractor->find("count", array(
													"conditions" => array(
																		"contractor_specialty_id" => $this->id
																		)
																	));
		if ($count == 0) {
			return true;
		} else {
			return false;
		}
	}
}