<?php
class Storage extends AppModel {
	var $name = 'Storage';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'model_id',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Vote'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	
	/**
	 * Update the feed with the latest held item
	 * @param 
	 * @return 
	 * 
	*/
	public function updateFeed($id=null){
		$this->recursive = 1;
		if($id){			
			$last = $this->read(null,$id);
			if(!empty($last['Storage']['user_id'])){
				//Add the feed data to the feed
				$this->Feed->addFeedData('Storage',$last);
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
		$this->recursive = 1;
		$this->User->recursive = -1;
		$data = $this->read(null,$model_id);
		return $data;
	}
}
