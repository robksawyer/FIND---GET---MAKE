<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';
	var $virtualFields = array(
		'full_name' => "CONCAT(fname, ' ', lname)"
	);
	
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
	
	var $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'Must be alphabets and numbers only'
			),
			'between' => array(
				'rule' => array('between', 3, 25),
				'message' => 'Must be between 3 to 25 characters'
			)
		),
		'password' => array(
			'empty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Password is required',
			)
		),
		'password_confirm' => array(
			'empty' => array(
				'rule' => 'notEmpty',
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Please confirm the password.',
			)
		),
		'email' => array(
			'empty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Email is required',
			),
			'valid' => array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Please enter a valid email address',
			)
		)
	);
	
	/** 
	 * Checks User data is valid before allowing access to system 
	 * @param array $data 
	 * @return boolean|array 
	 */	 
	function check_user_data($data) {
		// init	 
		$return = FALSE;

		// find user with passed username
		$conditions = array(
			'User.username'=>$data['User']['username'],
			'User.status'=>'1'	
		);	
		$user = $this->find('first',array('conditions'=>$conditions));	

		// not found
		if(!empty($user)) {	 
			$salt = Configure::read('Security.salt');
			// check password
			if($user['User']['password'] == md5($data['User']['password'].$salt)) {	 
				$return = $user;
			}
		}

		return $return;	 
	}
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'user_id',
			'dependent' => false,
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
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Contractor' => array(
			'className' => 'Contractor',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'House' => array(
			'className' => 'House',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SourceCategory' => array(
			'className' => 'SourceCategory',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductCategory' => array(
			'className' => 'ProductCategory',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ContractorSpecialty' => array(
			'className' => 'ContractorSpecialty',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Ufo' => array(
			'className' => 'Ufo',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Ownership' => array(
			'className' => 'Ownership',
			'foreignKey' => 'user_id',
			'dependent' => false
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
	function updateTotalLikesDislikes($model=null,$user_id=null){
		$this->id = $user_id;
		$totalLikes = $this->Vote->getAllUserLikes($model,$user_id);
		$totalDislikes = $this->Vote->getAllUserDislikes($model,$user_id);
		//Update the database fields
		$this->saveField('total'.$model.'Likes',$totalLikes);
		$this->saveField('total'.$model.'Dislikes',$totalDislikes);
	}

}
