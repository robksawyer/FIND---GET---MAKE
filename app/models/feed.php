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
	 * @param offset The offset to pull data from in the query
	 * @return array data
	 * 
	*/
	function getUserFeedData($user_id=null,$offset=0){
		$this->recursive = 1;
		$data = $this->find('all',array('conditions'=>array(
															'Feed.user_id'=>$user_id
															),
															'order'=>array('Feed.record_created'=>'desc'),
															'offset'=>$offset,
															'limit'=>10
															));
		return $data;
	}
	
	/**
	 * Handles returning a group of feeds for users. The method finds then packs an array full of the feed data for the items.
	 * @param array user_id The user you're trying to find the feed for.
	 * @param offset The offset to pull data from in the query
	 * @return array user_feed_data
	 * 
	*/
	public function getUsersFollowingFeedData($user_ids=null,$offset=0){
		$this->recursive = -1;
		$user_feeds = $this->getUserFeedData($user_ids,$offset);
		
		$user_feed_data = array();
		foreach($user_feeds as $feed_item){
			$this->$feed_item['Feed']['model']->recursive = 1;
			$user_feed_data[] = $this->$feed_item['Feed']['model']->read(null,$feed_item['Feed']['model_id']);
		}
		//debug($user_feed_data);
		return $user_feed_data;
	}
	
	/**
	 * Get the total items in the users' feed
	 * @param Array user_ids users ids of the followed
	 * @return 
	 * 
	*/
	function getFeedCount($user_ids=null){
		$this->recursive = 1;
		$count = $this->find('count',array('conditions'=>array(
															'Feed.user_id'=>$user_ids
															)
															));
		return $count;
	}
	
	/**
	 * Handles returning the feed for a particular user
	 * @param id follow_user_id The followed user
	 * @param offset The offset to pull data from in the query
	 * @return array user_details 
	 * 
	*/
	public function getFeed($user_id=null,$offset=0){
		$this->recursive = 1;
		$user_details = $this->find('all',array('recursive'=>1,
												'conditions'=>array(
																	'Feed.user_id'=>$user_id
																	),
												'order'=>'Feed.record_created DESC'
												));
		return $user_details;
	}
	
	/**
	 * Handles returning the feed details (items) for a particular user
	 * @param id follow_user_id The followed user
	 * @param offset The offset to pull data from in the query
	 * @return array user_details 
	 * 
	*/
	public function getFeedDetails($user_id=null,$offset=0){
		$this->recursive = 1;
		$user_details = $this->getUserFeedData($user_id,$offset=0);
		//debug($user_details);
		$user_feed_data = array();
		foreach($user_details as $feed_item){
			$this->$feed_item['Feed']['model']->recursive = 1;
			$user_feed_data[] = $this->$feed_item['Feed']['model']->getFeedData($feed_item['Feed']['model_id']);
		}
		return $user_feed_data;
	}
	
}
