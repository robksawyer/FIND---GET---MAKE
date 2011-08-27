<?php
class User extends AppModel {
	
	var $name = 'User';
	
	var $displayField = 'username';
	
	var $actsAs = array(
						'Tags.Taggable',
						'Search.Searchable',
						'TwitterKit.Twitter'
						/*'Uploader.FileValidation' => array(
							'fileName' => array(
								'extension' => array(
									'value' => array('gif', 'jpg', 'png', 'jpeg'),
									'error' => 'This image type is not supported.',
								)
								'filesize' => array(
									'value' => 5242880,
									'error' => 'The filesize is incorrect. Please make sure that the file meets the specs.'
								)
								'optional' => array(
									'value' => true
								)
							)
						)*/
					);
	
	var $filterArgs = array(
				array('name' => 'fullname', 'type' => 'like'),
				array('name' => 'username', 'type' => 'like'),
				array('name' => 'url', 'type' => 'like'),
				array('name' => 'search', 'type' => 'like', 'field' => 'User.fullname')
				/*
				array('name' => 'range_start', 'type' => 'expression', 'method' => 'makeRangeStartCondition', 'field' => 'Project.start BETWEEN ? AND ?'),
				array('name' => 'range_due', 'type' => 'expression', 'method' => 'makeRangeDueCondition', 'field' => 'Project.due BETWEEN ? AND ?')*/
			);
							
	/**
	 * Constants specific to changing the status of a user.
	 *
	 * @access public
	 * @var string
	 */
	const STATUS_BANNED = 1;
	const STATUS_ACTIVE = 0;

	/**
	 * Table prefix.
	 *
	 * @access public
	 * @var string
	 */
	var $tablePrefix = '';
	
	
	/**
	 * A column map allowing you to define the name of certain user columns.
	 *
	 * @access public
	 * @var array
	 */
	var $columnMap = array(
		'status'					=> 'status',
		'signature'					=> 'signature',
		'locale'					=> 'locale', // Must allow 3 characters: eng
		'timezone'					=> 'timezone', // Must allow 5 digits: -10.5
		'totalPosts'				=> 'totalPosts',
		'totalTopics'				=> 'totalTopics',
		'totalUfos'					=> 'totalUfos',
		'totalProducts'				=> 'totalProducts',
		'totalProductLikes'			=> 'totalProductLikes',
		'totalProductDislikes'		=> 'totalProductDislikes',
		'totalSources'				=> 'totalSources',
		'totalSourceLikes'			=> 'totalSourceLikes',
		'totalSourceDislikes'		=> 'totalSourceDislikes',
		'totalInspirations'			=> 'totalInspirations',
		'totalInspirationLikes'		=> 'totalInspirationLikes',
		'totalInspirationDislikes'	=> 'totalInspirationDislikes',
		'totalCollections'			=> 'totalCollections',
		'totalCollectionLikes'		=> 'totalCollectionlikes',
		'totalCollectionDislikes'	=> 'totalCollectionDislikes',
		'totalUfos'					=> 'totalUfos',
		'totalUfoLikes'				=> 'totalUfoLikes',
		'totalUfoDislikes'			=> 'totalUfoDislikes',
		'totalFollowers'			=> 'totalFollowers',
		'totalUsersFollowing'		=> 'totalUsersFollowing',
		'currentLogin'				=> 'currentLogin',
		'lastLogin'					=> 'lastLogin'
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
			'dependent' => true,
			'exclusive' => true
		),
		'Ownership' => array(
			'className' => 'Ownership',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		),
		'UserFollowing' => array(
			'className' => 'UserFollowing',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		),
		'Topic' => array(
			'className'	=> 'Forum.Topic',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		),
		'Post' => array(
			'className'	=> 'Forum.Post',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		),
		'Moderator' => array(
			'className'	=> 'Forum.Moderator',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		),
		'Access' => array(
			'className'	=> 'Forum.Access',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	/**
	 * Extra validation checking.
	 * 
	 * @access public
	 * @return boolean
	 */
	public function beforeValidate() {
		$action = (isset($this->action) ? $this->action : null);
		
		if ($action == 'login') {
			unset($this->validate['username']['isUnique']);
			
		} else if ($action == 'signup') {
			$this->validate['security'] = array(
				'equalTo' => array(
					'rule' => array('equalTo', ForumConfig::getInstance()->settings['security_answer']),
					'message' => 'Your security answer is incorrect, please try again!'
				),
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'The security answer is required to proceed'
				),
				'required' => true
			);
		}
		
		return true;
	}
	
	
	/**
	 * Don't show users that aren't active
	 * @param Array queryData Data from the find. 
	 * @return Array
	 * 
	*/
	public function beforeFind($queryData){
		$conditions = $queryData['conditions'];
		
		if(!is_array($conditions)) {
			if(!$conditions) {
				$conditions = array();
			}else {
				$conditions = array($conditions);
			}
		}
		
		if(!array_key_exists('active',$conditions) && !isset($conditions[$this->alias.'.active'])) {
			$conditions[$this->alias.'.active'] = 1;
		}
		$queryData['conditions'] = $conditions;
		$queryData['recursive'] = 1;
		return $queryData;
	}
	
	/**************** BORROWED FROM CUPCAKE ************************/
	/**
	 * Retrieve and reset information for a forgotten password.
	 *
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function forgotRetrieval($data) {
		$user = $this->find('first', array(
			'conditions' => array(
				'OR' => array(
					array('User.email' => $data['User']['email']),
					array('User.username' => $data['User']['username'])	
				)
			)
		));
		
		if (empty($user)) {
			$this->invalidate('username', 'No user was found with either of those credentials');
			return false;
		}
		
		return $user;
	}
	
	/**
	 * Generates a string of random characters.
	 *
	 * @access public
	 * @param int $length
	 * @return string
	 */
	public function generate($length = 10) {
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$return = '';
		
		if ($length > 0) {
			$totalChars = mb_strlen($characters) - 1;
			for ($i = 0; $i <= $length; ++$i) {
				$return .= $characters[rand(0, $totalChars)];
			}
		}
		
		return $return;
	}
	
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
	 * Get the latest users signed up.
	 *
	 * @access public
	 * @param $limit
	 * @return array
	 */
	public function getLatest($limit = 10) {
		return $this->find('all', array(
			'limit' => $limit,
			'order' => 'User.created DESC'
		));
	}

	/**
	 * Get the newest signup.
	 *
	 * @access public
	 * @return array
	 */
	public function getNewestUser() {
		return $this->find('first', array(
			'fields' => array('User.id', 'User.username'),
			'order' => 'User.created DESC',
			'limit' => 1
		));
	}
	
	/**
	 * Increase the post count.
	 *
	 * @access public
	 * @param int $id
	 * @return boolean
	 */
	public function increasePosts($id) {
		return $this->query("UPDATE `". $this->tablePrefix ."users` AS `User` SET `User`.`". $this->columnMap['totalPosts'] ."` = `User`.`". $this->columnMap['totalPosts'] ."` + 1 WHERE `User`.`id` = $id");
	}
	
	/**
	 * Increase the topic count.
	 *
	 * @access public
	 * @param int $id
	 * @return boolean
	 */
	public function increaseTopics($id) {
		return $this->query("UPDATE `". $this->tablePrefix ."users` AS `User` SET `User`.`". $this->columnMap['totalTopics'] ."` = `User`.`". $this->columnMap['totalTopics'] ."` + 1 WHERE `User`.`id` = $id");
	}
	
	/**
	 * Checks to see if the old password matches their input.
	 *
	 * @access public
	 * @param array $data
	 * @return boolean
	 */
	public function isPassword($data) {
		$user = $this->find('first', array(
			'conditions' => array('User.id' => $_SESSION['Auth']['User']['id']),
			'fields' => array('User.password'),
			'contain' => false
		));
		
		$data = array_values($data);
		$var1 = Security::hash($data[0], null, true);
		$var2 = $user['User']['password'];
		
		return ($var1 === $var2);
	}	
	
	/**
	 * Login the user and update records.
	 *
	 * @access public
	 * @param array $user
	 * @return boolean
	 */
	public function login($user) {
		if (!empty($user)) {
			$data = array();
			$data[$this->columnMap['currentLogin']] = date('Y-m-d H:i:s');
			$data[$this->columnMap['lastLogin']] = $user['User']['currentLogin'];

			$this->id = $user['User']['id'];
			return $this->save($data, false, array_keys($data));
		}
		
		return true;
	}
	
	/**
	 * Change the users password.
	 *
	 * @access public
	 * @param int $id
	 * @param string $password
	 * @return boolean
	 */
	public function resetPassword($id, $password) {
		$this->id = $id;
		return $this->saveField('password', $password);
	}
	
	/**
	 * Get whos online within the past x minutes.
	 *
	 * @access public
	 * @param int $minutes
	 * @return array
	 */
	public function whosOnline($minutes) {
		$past = date('Y-m-d H:i:s', strtotime('-'. $minutes .' minutes'));
		
		return $this->find('all', array(
			'conditions' => array('User.'. $this->columnMap['currentLogin'] .' >' => $past),
			'fields' => array('User.id', 'User.username'),
			'contain' => false
		));
	}
	/**************** END BORROWED FROM CUPCAKE ************************/
	
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
