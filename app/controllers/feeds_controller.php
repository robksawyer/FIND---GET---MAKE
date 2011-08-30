<?php
class FeedsController extends AppController {

	var $name = 'Feeds';
	
	var $uses = array('Feed');
	
	var $paginate = array(
		'Feed' => array(
			'limit' => 25,
			'order' => array(
				'Feed.record_created' => 'desc',
			),
		),
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('user');
		
	}
	
	/**
	 * Spits out the recent additions from user passed
	 * @param string username 
	 * @return 
	 * 
	*/
	function me(){
		$user = $this->Auth->user();
		$user = $this->Feed->User->read(null,$user['User']['id']);
		//debug($user['UserFollowing']);
		$user_ids = array();
		$feed = array();
		if(!empty($user)){
			/*
				TODO Set up pagination
			*/
			$feed = $this->Feed->User->getFeedDetails($user['User']['id']);
			$this->set(compact('feed','user'));
		}else{
			$this->Session->setFlash(__('This is an invalid user.', true));
			$this->redirect('/');
		}
	}
	
	/**
	 * Spits out the recent additions from user passed
	 * @param string username 
	 * @return 
	 * 
	*/
	function user($username=null){
		if(is_int($username)){
			$id = $username;
			$user = $this->Feed->User->read(null,$id);
		}else{
			$userTemp = $this->Feed->User->find('first',array('conditions'=>array('username'=>$username)));
			$id = $userTemp['User']['id'];
			$user = $this->Feed->User->read(null,$id);
		}
		//debug($user['UserFollowing']);
		$user_ids = array();
		$feed = array();
		if(!empty($user)){
			/*
				TODO Set up pagination
			*/
			$feed = $this->Feed->User->getFeedDetails($user['User']['id']);
			$this->set(compact('feed','user'));
		}else{
			$this->Session->setFlash(__('This is an invalid user.', true));
			$this->redirect('/');
		}
	}
	
	/**
	 * Spits out the recent additions from followed users
	 * @param 
	 * @return 
	 * 
	*/
	function display(){
		//Get the logged in user
		$user = $this->Auth->user();
		if(empty($user)){
			$this->Session->setFlash(__('You must be logged in to access this area.', true));
			$this->redirect('/users/login');
		}
	}
	
	/**
	 * Returns the feed data for the following people of the logged in user
	 * @param int user_id
	 * @return 
	 * 
	*/
	function getUsersFollowingFeedData($offset=0){
		$user_id = $this->Auth->user('id');
		//$user = $this->Feed->User->read(null,$user_id);
		$following_user_ids = $this->Feed->User->getFollowingUserIds($user_id);
		$feed = $this->Feed->getUsersFollowingFeedData($following_user_ids,$offset);
		return $feed;
	}
	
	/**
	 * Returns the total number of items in a feed
	 * @param 
	 * @return 
	 * 
	*/
	function getUsersFollowingFeedCount(){
		$user_id = $this->Auth->user('id');
		$following_user_ids = $this->Feed->User->getFollowingUserIds($user_id);
		return $this->Feed->getFeedCount($following_user_ids);
	}
	
	/**
	 * Returns the feed data for a user
	 * @param int user_id
	 * @param offset
	 * @return 
	 * 
	*/
	function getUserFeed($user_id=null,$offset=0){
		$feed = $this->Feed->getUserFeedDataDetails($user_id,$offset);
		return $feed;
	}
	
	/**
	 * Returns the total number of items in a feed
	 * @param int user_id
	 * @return 
	 * 
	*/
	function getUserFeedCount($user_id=null){
		return $this->Feed->getFeedCount($user_id);
	}
	
	/**
	 * Generate a feed for a user if it doesn't exist
	 * @param string username
	 * @return 
	 * 
	*/
	function admin_generate($username=null){
		$this->Feed->recursive = 1;
		if (!$username) {
			$this->Session->setFlash(__('Invalid username', true));
			$this->redirect(array('admin'=>true,'action' => 'moderate'));
		}
		$user = $this->Feed->User->findByUsername($username);
		if (!$user) {
			$this->Session->setFlash(__('Invalid username', true));
			$this->redirect(array('admin'=>true,'action' => 'moderate'));
		}
		//debug($user);
		//Generate feed items for each type
		$counter = 0;
		//Collections
		foreach($user['Collection'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Collection';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Collection');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		} 
		
		//Inspirations
		foreach($user['Inspiration'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Inspiration';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Inspiration');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		}
		
		//Products
		foreach($user['Product'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Product';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Product');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		}
		
		//Sources
		foreach($user['Source'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Source';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Source');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		}
		
		//Ufos
		foreach($user['Ufo'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Ufo';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Ufo');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		}
		
		//Ownerships
		foreach($user['Ownership'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Ownership';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Ownership');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		}
		
		//Votes
		foreach($user['Vote'] as $item){
			$this->data[$counter]['Feed']['model'] = 'Vote';
			$this->data[$counter]['Feed']['user_id'] = $item['user_id'];
			$this->data[$counter]['Feed']['name'] = strtolower('Vote');
			$this->data[$counter]['Feed']['model_id'] = $item['id'];
			$this->data[$counter]['Feed']['record_created'] = $item['created'];
			$counter++;
		}
		//debug($this->data);
		//Save the feed to the database
		if($this->Feed->saveAll($this->data)){
			$success = 1;
			$records = $this->data;
		}else{
			$success = 0;
			$records = 0;
		}
		
		$this->set(compact('success','records'));
		//Generate a feed record for each addition that the user crated
		 
	}
}
