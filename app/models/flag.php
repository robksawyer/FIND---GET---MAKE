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
			'conditions' => array('Flag.model' => 'Product'),
			'fields' => '',
			'order' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model'=>'Source'),
			'fields' => '',
			'order' => ''
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model'=>'Inspiration'),
			'fields' => '',
			'order' => ''
		),
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model'=>'Collection'),
			'fields' => '',
			'order' => ''
		),
		'Ufo' => array(
			'className' => 'Ufo',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model'=>'Ufo'),
			'fields' => '',
			'order' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model'=>'Attachment'),
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
