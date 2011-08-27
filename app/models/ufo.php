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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Ufo'),
			'dependent' => true,
			'exclusive' => true
		),
		'Flag' => array(
			'className' => 'Flag',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model' => 'Ufo'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	/**
	 * Don't show products that aren't active
	 * @param Array queryData Data from the find. 
	 * @return Array
	 * 
	*/
	function beforeFind($queryData){
		$conditions = $queryData['conditions'];
		
		if(!is_array($conditions)) {
			if(!$conditions) {
				$conditions = array();
			}else {
				$conditions = array($conditions);
			}
		}
		
		if(!array_key_exists('active',$conditions) && !isset($conditions[$this->alias.'.active'])) {
			$conditions[$this->alias.'.active'] = 1;
		}
		$queryData['conditions'] = $conditions;
		$queryData['recursive'] = 1;
		return $queryData;
	}
	
	/**
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	public function afterSave($created){
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['User']['id'])){
				$this->User->updateTotalUfos($last['User']['id']);
				
				//Add the feed data to the feed
				$this->Feed->addFeedData('Ufo',$last);
			}
		}
	}
	
	/**
	 * Returns the needed feed data for a specific record
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function getFeedData($model_id=null){
		$this->recursive = 2;
		$this->User->recursive = -1;
		$data = $this->read(null,$model_id);	
		
		return $data;
	}
	
	/**
	 * Get the most recent ufos for a specific user
	 *
	 * @param int $user_id The user id of the user you're trying to pull ufos for.
	 * @param int $limit The number of results to return
	 * @return Array
	 **/
	function userUfos($user_id=null,$limit=10,$type=null){
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
