<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';
	var $actsAs = array('TwitterKit.Twitter');
	
	/**
	 * A column map allowing you to define the name of certain user columns.
	 *
	 * @access public
	 * @var array
	 */
	var $columnMap = array(
		'status'		=> 'status',
		'signature'		=> 'signature',
		'locale'		=> 'locale', // Must allow 3 characters: eng
		'timezone'		=> 'timezone', // Must allow 5 digits: -10.5
		'totalPosts'	=> 'totalPosts',
		'totalTopics'	=> 'totalTopics',
		'currentLogin'	=> 'currentLogin',
		'lastLogin'		=> 'lastLogin'
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Contractor' => array(
			'className' => 'Contractor',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'House' => array(
			'className' => 'House',
			'foreignKey' => 'user_id',
			'dependent' => true
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'SourceCategory' => array(
			'className' => 'SourceCategory',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'ProductCategory' => array(
			'className' => 'ProductCategory',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'ContractorSpecialty' => array(
			'className' => 'ContractorSpecialty',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Ufo' => array(
			'className' => 'Ufo',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'user_id',
			'dependent' => true
		),
		'Ownership' => array(
			'className' => 'Ownership',
			'foreignKey' => 'user_id',
			'dependent' => true
		),
		'UserFollowing' => array(
			'className' => 'UserFollowing',
			'foreignKey' => 'user_id',
			'dependent' => true
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'user_id',
			'dependent' => true
		)
	);
	
	/**
	 * Get a users profile: info, access levels, moderations.
	 *
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function getProfile($id) {
		return $this->find('first', array(
			'conditions' => array('User.id' => $id),	
			'contain' => array(
				'Access' => array('AccessLevel'),
				'Moderator' => array('ForumCategory')
			)
		));
	}
	
	/**
	 * Updates the total likes and dislikes for a specific user
	 * @param string model The model to target
	 * @param int user_id
	 * @return 
	 * 
	*/
	public function updateTotalLikesDislikes($model=null,$user_id=null){
		$this->id = $user_id;
		$totalLikes = $this->Vote->getAllUserLikes($model,$user_id);
		$totalDislikes = $this->Vote->getAllUserDislikes($model,$user_id);
		//Update the database fields
		$this->saveField('total'.$model.'Likes',$totalLikes);
		$this->saveField('total'.$model.'Dislikes',$totalDislikes);
	}
	
	/**
	 * Updates the total follow count for a particular user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalFollowCount($user_id=null){
		$this->id = $user_id;
		$totalFollows = $this->UserFollowing->getFollowCount($user_id);
		$this->saveField('totalUsersFollowing',$totalFollows);
	}
	
	/**
	 * Updates the total follower count for a particular user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalFollowerCount($user_id=null){
		$this->id = $user_id;
		$totalFollowers = $this->UserFollowing->getFollowerCount($user_id);
		$this->saveField('totalFollowers',$totalFollowers);
	}
	
	/**
	 * Updates the total count of products added by this user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalProducts($user_id=null){
		$this->id = $user_id;
		$total = $this->getTotalProducts($user_id);
		$this->saveField('totalProducts',$total);
	}
	
	/**
	 * Returns the total number of products for a user
	 * @param int user_id The user targeting
	 * @return int total 
	 * 
	*/
	public function getTotalProducts($user_id=null){
		$this->id = $user_id;
		$total = $this->Product->find('count',array('conditions'=>array('Product.user_id'=>$user_id)));
		return $total;
	}
	
	
	/**
	 * Updates the total count of sources added by this user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalSources($user_id=null){
		$this->id = $user_id;
		$total = $this->getTotalSources($user_id);
		$this->saveField('totalSources',$total);
	}
	
	/**
	 * Returns the total number of sources for a user
	 * @param int user_id The user targeting
	 * @return int total 
	 * 
	*/
	public function getTotalSources($user_id=null){
		$this->id = $user_id;
		$total = $this->Source->find('count',array('conditions'=>array('Source.user_id'=>$user_id)));
		return $total;
	}
	
	/**
	 * Updates the total count of inspirations added by this user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalInspirations($user_id=null){
		$this->id = $user_id;
		$total = $this->getTotalInspirations($user_id);
		$this->saveField('totalInspirations',$total);
	}
	
	/**
	 * Returns the total number of inspirations for a user
	 * @param int user_id The user targeting
	 * @return int total 
	 * 
	*/
	public function getTotalInspirations($user_id=null){
		$this->id = $user_id;
		$total = $this->Inspiration->find('count',array('conditions'=>array('Inspiration.user_id'=>$user_id)));
		return $total;
	}
	
	/**
	 * Updates the total count of collections added by this user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalCollections($user_id=null){
		$this->id = $user_id;
		$total = $this->getTotalCollections($user_id);
		$this->saveField('totalCollections',$total);
	}
	
	/**
	 * Returns the total number of collections for a user
	 * @param int user_id The user targeting
	 * @return int total 
	 * 
	*/
	public function getTotalCollections($user_id=null){
		$this->id = $user_id;
		$total = $this->Collection->find('count',array('conditions'=>array('Collection.user_id'=>$user_id)));
		return $total;
	}
	
	/**
	 * Updates the total count of ufos added by this user
	 * @param user_id The user to target
	 * @return 
	 * 
	*/
	public function updateTotalUfos($user_id=null){
		$this->id = $user_id;
		$total = $this->getTotalUfos($user_id);
		$this->saveField('totalUfos',$total);
	}
	
	/**
	 * Returns the total number of ufos for a user
	 * @param int user_id The user targeting
	 * @return int total 
	 * 
	*/
	public function getTotalUfos($user_id=null){
		$this->id = $user_id;
		$total = $this->Ufo->find('count',array('conditions'=>array('Ufo.user_id'=>$user_id)));
		return $total;
	}
	
	/**
	 * Find a user by his username
	 * @param string username The username to search for
	 * @return 
	 * 
	*/
	public function findByUsername($username=null){
		$user = $this->find('first',array('conditions'=>array('User.username'=>$username)));
		return $user;
	}
	
	/**
	 * Handles finding information about the user being followed
	 * @param id follow_user_id The followed user
	 * @return array user_details 
	 * 
	*/
	public function getFollowerDetails($follow_user_id=null){
		$this->recursive = -1;
		$user_details = $this->find('first',array('conditions'=>array(
																	'User.id'=>$follow_user_id
																	),
												'fields'=>array('id','username','slug',
																'created','status','email',
																'totalSources','totalProducts','totalInspirations',
																'totalCollections','totalUfos',
																'totalPosts','totalTopics','totalProductLikes',	
																'totalProductDislikes','totalUsersFollowing'
																)
												));
		return $user_details;
	}
	
	/**
	 * Returns the ids of the users the logged in user is following
	 * @param int user_id The logged in user
	 * @return array user_id The people the logged in user is following
	 * 
	*/
	public function getFollowingUserIds($user_id=null){
		return $this->UserFollowing->getFollowingUserIds($user_id);
	}
}
