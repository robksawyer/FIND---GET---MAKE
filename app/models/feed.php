<?php
class Feed extends AppModel {
	var $name = 'Feed';
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
		'Inspiration' => array(
			'className' => 'Inspiration',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ownership' => array(
			'className' => 'Ownership',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * Handles updating the feed
	 * @param string model The model to target
	 * @param int data The item data
	 * @return 
	 * 
	*/
	function addFeedData($model=null,$data=null){
		$this->set('model',$model);
		$this->set('name',strtolower($model));
		$this->set('user_id',$data['User']['id']);
		$this->set('model_id',$data[$model]['id']);
		$this->set('record_created',$data[$model]['created']);
		
		if($this->save()){
			//The data saved correctly
		}else{
			//There was an error saving the data
		}
	}
	
	/**
	 * Finds the feed data for a user.
	 * @param int user_id
	 * @return array data
	 * 
	*/
	function getUserFeedData($user_id=null){
		$this->recursive = 1;
		$data = $this->find('all',array('conditions'=>array(
															'Feed.user_id'=>$user_id
															),
															'order'=>array('Feed.record_created'=>'desc')
															));
		return $data;
	}
}
