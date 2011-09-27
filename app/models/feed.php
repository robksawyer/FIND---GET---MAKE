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
		),
		'Ufo' => array(
			'className' => 'Ufo',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'StaffFavorite' => array(
			'className' => 'StaffFavorite',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserFollowing' => array(
			'className' => 'UserFollowing',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Storage' => array(
			'className' => 'Storage',
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
	public function addFeedData($model=null,$data=null){
		if($model && $data){
			
			if(empty($data['User']['id'])){
				//Check to see if the item exists already
				$feedChecker = $this->find('first',array('conditions'=>array(
																'Feed.user_id'=>$data[$model]['user_id'],
																'Feed.model'=>$model,
																'Feed.model_id'=>$data[$model]['id']
															)
														));
														
				if(empty($feedChecker)) $this->set('user_id',$data[$model]['user_id']); //This is a special case for ownerships
			}else{
				//Check to see if the item exists already
				$feedChecker = $this->find('first',array('conditions'=>array(
																'Feed.user_id'=>$data['User']['id'],
																'Feed.model'=>$model,
																'Feed.model_id'=>$data[$model]['id']
															)
														));
				if(empty($feedChecker)) $this->set('user_id',$data['User']['id']);
			}
			
			//Make sure that the user doesn't already have something related to the item in the feed 
			if(empty($feedChecker)){
				$this->set('model',$model);
				$this->set('name',strtolower($model));
				$this->set('model_id',$data[$model]['id']);
				$this->set('record_created',$data[$model]['modified']);
				
				if($this->save()){
					//The data saved correctly
				}else{
					//There was an error saving the data
				}
			}else{
				$this->id = $feedChecker['Feed']['id'];
				$this->set('record_created',$data[$model]['modified']);
			}
		}
	}
	
	/**
	 * Handles removing an item from the feed
	 * @param string model The model to target
	 * @param int data The item data
	 * @return 
	 * 
	*/
	public function removeFeedData($model=null,$data=null){
		if($model && $data){
			$item = $this->find('first',array(
											'conditions'=>array(
																'Feed.model'=>$model,
																'Feed.model_id'=>$data[$model]['id']
																)
											)
										);

			if(!empty($item)){
				//Delete the item from the feed
				if($this->delete($item['Feed']['id'])){
					//The item was deleted
				}else{
					//There was an error deleting the item
				}
			}
		}
	}
	
	/**
	 * Finds the feed data for a user.
	 * @param int user_id
	 * @param offset The offset to pull data from in the query
	 * @return array data
	 * 
	*/
	public function getUserFeedData($user_id=null,$offset=0){
		$this->recursive = -1;
		$data = $this->find('all',array('conditions'=>array(
															'Feed.user_id'=>$user_id
															),
															'order'=>array('Feed.created'=>'desc'),
															'offset'=>$offset,
															'limit'=>10
															));
		//debug($data);
		return $data;
	}
	
	
	/**
	 * Finds the feed data for a user.
	 * @param int user_id
	 * @param offset The offset to pull data from in the query
	 * @return array data
	 * 
	*/
	public function getUserFeedDataDetails($user_id=null,$offset=0){
		$this->recursive = -1;
		$user_feed = $this->getUserFeedData($user_id,$offset);
		
		$user_feed_data = array();
		foreach($user_feed as $feed_item){
			$the_model = $feed_item['Feed']['model'];
			switch($the_model){
				
				case "Ownership":
					$temp_data = $this->getOwnershipFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
				
				case "Vote":
					$temp_data = $this->getVoteFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
					
				case "Collection":
					$temp_data = $this->getCollectionFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
				
				case "Ufo":
					$temp_data = $this->getUfoFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
					
				case "Product":
					$temp_data = $this->getProductFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
				
				case "UserFollowing":
					$temp_data = $this->getUserFollowingFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
					
				default:
					$temp_data = $this->getStandardFeedData($the_model,$feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
	
			}
			
			if(!empty($temp_data)){
				$user_feed_data[] = $temp_data;
			}
		}
		return $user_feed_data;
	}
	
	/**
	 * Handles returning a group of feeds for users. The method finds then packs an array full of the feed data for the items.
	 * @param array user_id The user you're trying to find the feed for.
	 * @param offset The offset to pull data from in the query
	 * @return array user_feed_data
	 * 
	*/
	public function getUsersFollowingFeedDataDetails($user_ids=null,$offset=0){
		$this->recursive = -1;
		$user_feed = $this->getUserFeedData($user_ids,$offset);
		
		$user_feed_data = array();
		foreach($user_feed as $feed_item){
			$the_model = $feed_item['Feed']['model'];
			switch($the_model){
				
				case "Ownership":
					$temp_data = $this->getOwnershipFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
				
				case "Vote":
					$temp_data = $this->getVoteFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
					
				case "Collection":
					$temp_data = $this->getCollectionFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
				
				case "Ufo":
					$temp_data = $this->getUfoFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
					
				case "Product":
					$temp_data = $this->getProductFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
				
				case "UserFollowing":
					$temp_data = $this->getUserFollowingFeedData($feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
						
				default:
					$temp_data = $this->getStandardFeedData($the_model,$feed_item['Feed']['id'],$feed_item['Feed']['model_id']);
					break;
	
			}

			if(!empty($temp_data)){
				$user_feed_data[] = $temp_data;
			}
		}
		//debug($user_feed_data);
		return $user_feed_data;
	}
	
	/**
	 * Find the data associated with a certain item.
	 * @param string the_model The model to target
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getStandardFeedData($the_model='',$feed_id=null,$model_id=null){
		$data = $this->$the_model->find('first',array(
														'conditions'=>array(
																$the_model.'.id'=>$model_id
														),
														'contain'=>array('Tag',
																		'Product'=>array('Attachment'),
																		'Attachment','User',
																		'Feed'=>array('conditions'=>array('Feed.id'=>$feed_id)
																		)
																	)
														)
													);
		return $data;
	}
	
	/**
	 * Find the data associated with a certain item.
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getProductFeedData($feed_id=null,$model_id=null){
		$data = $this->Product->find('first',array(
												'conditions'=>array(
														'Product.id'=>$model_id
												),
												'contain'=>array('Tag','User','Attachment',
																'Feed'=>array('conditions'=>array('Feed.id'=>$feed_id)),
																'Vote','Ownership'
																)
												)
											);
		return $data;
	}
	
	/**
	 * Find the data associated with a certain item.
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getUfoFeedData($feed_id=null,$model_id=null){
		$data = $this->Ufo->find('first',array(
														'conditions'=>array(
																'Ufo.id'=>$model_id
														),
														'contain'=>array('Tag','User',
																		'Feed'=>array('conditions'=>array('Feed.id'=>$feed_id)),
																		'Vote'
																		)
														)
													);
		return $data;
	}
	
	/**
	 * Find the data associated with a certain item.
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getCollectionFeedData($feed_id=null,$model_id=null){
		$data = $this->Collection->find('first',array(
														'conditions'=>array(
																'Collection.id'=>$model_id
														),
														'contain'=>array('Tag',
																		'Product'=>array('Attachment','User'),
																		'User','Feed'=>array('conditions'=>array('Feed.id'=>$feed_id)),
																		'Vote'
																	)
														)
													);
		return $data;
	}
	
	/**
	 * Find the data associated with a certain item.
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getOwnershipFeedData($feed_id=null,$model_id=null){
		$data = $this->Ownership->find('first',array(
													'conditions'=>array(
															'Ownership.id'=>$model_id
													),
													'contain'=>array(
																	'Product'=>array('Tag','Attachment','User'),
																	'User','Feed'=>array('conditions'=>array('Feed.id'=>$feed_id))
																	)
													)
												);
		return $data;
	}
	
	/**
	 * Find the data associated with a certain item.
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getVoteFeedData($feed_id=null,$model_id=null){
		$data = $this->Vote->find('first',array(
												'conditions'=>array(
														'Vote.id'=>$model_id
												),
												'contain'=>array(
																//'Product'=>array('Tag','Attachment','User'),
																'User','Feed'=>array('conditions'=>array('Feed.id'=>$feed_id))
																)
												)
											);
		$data_item = $this->$data['Vote']['model']->read(null,$data['Vote']['model_id']);
		$data[$data['Vote']['model']] = $data_item[$data['Vote']['model']];
		return $data;
	}
	
	/**
	 * Find the data associated with the user following model
	 * @param int feed_id The feed item id
	 * @param int model_id The item id
	 * @return 
	 * 
	*/
	public function getUserFollowingFeedData($feed_id=null,$model_id=null){
		$data = $this->UserFollowing->find('first',array(
														'conditions'=>array(
																			'UserFollowing.id'=>$model_id
																			),
														'contain'=>array('User',
																		'Feed'=>array('conditions'=>array('Feed.id'=>$feed_id))
																		)
														)
													);
		$data['UserFollowed'] = $this->UserFollowing->User->read(null,$data['UserFollowing']['follow_user_id']);
		return $data;
	}
	
	/**
	 * Get the total items in the users' feed
	 * @param Array user_ids users ids of the followed
	 * @return 
	 * 
	*/
	public function getFeedCount($user_ids=null){
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
	 * DEPRECATED: This was used on the user and me pages.
	 * Handles returning the feed details (items) for a particular user
	 * @param id follow_user_id The followed user
	 * @param offset The offset to pull data from in the query
	 * @return array user_details 
	 * 
	*/
	/*public function getFeedDetails($user_id=null,$offset=0){
		$this->recursive = 1;
		$user_details = $this->getUserFeedData($user_id,$offset=0);
		//debug($user_details);
		$user_feed_data = array();
		foreach($user_details as $feed_item){
			$this->$feed_item['Feed']['model']->recursive = 1;
			$user_feed_data[] = $this->$feed_item['Feed']['model']->getFeedData($feed_item['Feed']['model_id']);
		}
		debug($user_feed_data);
		return $user_feed_data;
	}*/
}