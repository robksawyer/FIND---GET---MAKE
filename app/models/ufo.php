<?php
class Ufo extends AppModel {
	var $name = 'Ufo';
	var $displayField = 'name';
	
	var $actsAs = array(
					'Tags.Taggable'
			);
			
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'attachment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'Ufo'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	
	/**
	 * Get the most recent ufos for a specific user
	 *
	 * @param int $user_id The user id of the user you're trying to pull ufos for.
	 * @param int $limit The number of results to return
	 * @return Array
	 **/
	public function userUfos($user_id=null,$limit=10,$type=null){
		$this->recursive = 2;
		$items = $this->find('all',
									array(
										'conditions'=>array('Ufo.user_id' => $user_id),
										'limit' => $limit,
										'order' => array('Ufo.created DESC')
										)
									);
		return $items;
	}
}
