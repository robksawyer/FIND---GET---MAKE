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
			'conditions' => array('Feed.model' => 'Storage'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	
	/**
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	public function afterSave($created){
		$this->recursive = 1;
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['Storage']['user_id'])){
				//Add the feed data to the feed
				$this->Feed->addFeedData('Storage',$last);
			}
		}
	}
	
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
	 * @param int user_id The user id that is trying to add to storage
	 * @param string model
	 * @param int model_id
	 * @return array
	 * 
	*/
	public function getItem($user_id,$model="Product",$model_id){
		$stored_item = $this->find('first',array('conditions'=>array(
																	'AND'=>array(
																		array('Storage.user_id'=>$user_id),
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
													array("Storage.model_id" => $model_id),
													array("Storage.model" => $model)
												),
												'NOT'=>array(
													"Storage.user_id" => $user_id
												)
											),
											'limit'=>$limit,
											'contain'=>array(
												'User'=>array(
															'Attachment'=>array(
																				'conditions'=>array('Attachment.id'=>'User.attachment_id'),
																				'fields'=>array('Attachment.id','Attachment.path_med','Attachment.path_small')
															),
															'Storage'=>array(
																'order' => 'Storage.created DESC',
																'limit'=>3,
																'Product' => array(
																						'Attachment' => array('limit'=>1)
																						)
															)
												)
											)
										));
		return $users;
	}
	
	/**
	 * Adds an item to a user's storage
	 * @param int user_id 
	 * @param int model_id the id of the item to target
	 * @param string model the item type to target
	 * @return 
	 * 
	*/
	public function addItem($user_id,$model_id,$model="Product"){
		$this->recursive = -1;
		$productCheck = $this->find('count',array('conditions'=>array(
												'AND'=>array(
													array("Storage.id" => $model_id),
													array("Storage.model" => $model),
													array("Storage.user_id" => $user_id)
												)
											)
										));
		
		if(empty($productCheck)){
			$saveData = array();
			$saveData['Storage']['model'] = $model;
			$saveData['Storage']['model_id'] = $model_id;
			$saveData['Storage']['user_id'] = $user_id;
			$saveData['Storage']['name'] = Inflector::pluralize(strtolower($model));
			$this->create();
			if($this->save($saveData)){
				//Save successful
				return true;
			}else{
				return false;
			}
		}else{
			//The user has already added this product
			return true;
		}
	}
}
