<?php
class Flag extends AppModel {
	var $name = 'Flag';
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
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'model_id',
			'fields' => '',
			'order' => ''
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'foreignKey' => 'model_id',
			'fields' => '',
			'order' => ''
		),
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'model_id',
			'fields' => '',
			'order' => ''
		),
		'Ufo' => array(
			'className' => 'Ufo',
			'foreignKey' => 'model_id',
			'fields' => '',
			'order' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'model_id',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * Get the total number of flags in the system
	 * @param 
	 * @return int The total number of flagged items
	 * 
	*/
	public function getCount(){
		$count = $this->find('count');
		return $count;
	}
	
	
	/**
	 * Checks to see if the logged in user has flagged an item
	 * @param int user_id The logged in user id
	 * @param string model
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function hasUserFlagged($user_id=null,$model=null,$model_id=null){
		$flag = $this->find('first',array('conditions'=>array(
																'Flag.model' => $model,
																'Flag.model_id'=>$model_id,
																'Flag.user_id'=>$user_id
															)));
		if(empty($flag)) return false; else return true;
	}
	
	/**
	 * Get the total number of flags for a certain item
	 * @param string model The model to target
	 * @param int id The model id to target
	 * @return int The total number of flagged items
	 * 
	*/
	public function getItemCount($model=null,$id=null){
		$count = $this->find('count',array('conditions'=>array('Flag.model_id'=>$id,'Flag.model'=>$model)));
		return $count;
	}
	
	/**
	 * Get all of the flags in the system
	 * @param int offset The array offset number for the flags to return
	 * @param int limit The number of flags to return
	 * @return array items The items found 
	 * 
	*/
	public function getAll($offset=0,$limit=25,$count=false){
		$items = $this->find('all',array('offset'=>$offset,'limit'=>$limit));
		if($count) $items['count'] = $this->find('count');
		return $items;
	}
	
	/**
	 * Get the flags along with a count of all products in the system
	 * @param 
	 * @return array items The items found 
	 * 
	*/
	public function getAllProductFlags(){
		$items = $this->find('all',array('conditions'=>array('model'=>'Product')));
		$items['count'] = $this->find('count',array('conditions'=>array('model'=>'Product')));
		return $items;
	}
	
	/**
	 * Get the flags along with a count of all sources in the system
	 * @param 
	 * @return array items The items found 
	 * 
	*/
	public function getAllSourceFlags(){
		$items = $this->find('all',array('conditions'=>array('model'=>'Source')));
		$items['count'] = $this->find('count',array('conditions'=>array('model'=>'Source')));
		return $items;
	}
	
	/**
	 * Get the flags along with a count of all attachments in the system
	 * @param 
	 * @return array items The items found 
	 * 
	*/
	public function getAllAttachmentFlags(){
		$items = $this->find('all',array('conditions'=>array('model'=>'Attachment')));
		$items['count'] = $this->find('count',array('conditions'=>array('model'=>'Attachment')));
		return $items;
	}
	
	/**
	 * Get the flags along with a count of all inspirations in the system
	 * @param 
	 * @return array items The items found 
	 * 
	*/
	public function getAllInspirationFlags(){
		$items = $this->find('all',array('conditions'=>array('model'=>'Inspiration')));
		$items['count'] = $this->find('count',array('conditions'=>array('model'=>'Inspiration')));
		return $items;
	}
	
	/**
	 * Get the flags along with a count of all collections in the system
	 * @param 
	 * @return array items The items found 
	 * 
	*/
	public function getAllCollectionFlags(){
		$items = $this->find('all',array('conditions'=>array('model'=>'Collection')));
		$items['count'] = $this->find('count',array('conditions'=>array('model'=>'Collection')));
		return $items;
	}
	
	/**
	 * Get the flags along with a count of all ufos in the system
	 * @param 
	 * @return array items The items found 
	 * 
	*/
	public function getAllUfoFlags(){
		$items = $this->find('all',array('conditions'=>array('model'=>'Ufo')));
		$items['count'] = $this->find('count',array('conditions'=>array('model'=>'Ufo')));
		return $items;
	}
}
