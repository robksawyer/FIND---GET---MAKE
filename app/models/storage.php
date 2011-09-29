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
	
	/*var $hasMany = array(
		'Feed' => array(
			'className' => 'Storage',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Storage'),
			'dependent' => true,
			'exclusive' => true
		)
	);*/
	
	
	/**
	 * Update the feed with the latest held item
	 * @param 
	 * @return 
	 * 
	*/
	public function updateFeed($id=null){
		$this->recursive = -1;
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
	
	/**
	 * Returns the item details that was stored
	 * @param string model
	 * @param int model_id
	 * @return array
	 * 
	*/
	public function getItem($model="Product",$model_id){
		$stored_item = $this->find('first',array('conditions'=>array(
																	'AND'=>array(
																		array('Storage.model'=>$model),
																		array('Storage.model_id'=>$model_id)
																	)
																),
												'contain'=>array($model)
												)
											);
		return $stored_item;
	}
	
	/**
	 * Returns the user's storing a certain item.
	 * @param int user_id 
	 * @param int model_id the id of the item to target
	 * @param string model the item type to target
	 * @return 
	 * 
	*/
	public function getUsersStoring($user_id,$model_id,$model="Product",$limit=50){
		$this->recursive = -1;
		$users = $this->find('all',array('conditions'=>array(
												'AND'=>array(
													array("Storage.id" => $model_id),
													array("Storage.model" => $model)
												),
												'NOT'=>array(
													array("Storage.user_id" => $user_id)
												)
											),
											'limit'=>$limit,
											'contain'=>array(
												'Product'=>array('Attachment',
																'order' => 'Product.id DESC',
																'limit'=>3
																)
											)
										));
		
		return $users;
	}
}
