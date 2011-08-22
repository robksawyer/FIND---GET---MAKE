<?php
class UserFollowing extends AppModel {
	var $name = 'UserFollowing';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * Find the users that a certain user is following
	 * @param 
	 * @return 
	 * 
	*/
	public function findFollowing($user_id=null,$limit=10){
		$followers = $this->find('all',array('conditions'=>array(
													'UserFollowing.user_id'=>$user_id
													),
													'limit'=>$limit
													));
		return $followers;
	}
	
	/**
	 * Find the users following the passed user
	 * @param int user_id
	 * @return array users_following The users following the user
	 * 
	*/
	public function findFollowers($user_id=null,$limit=10){
		$users_following = $this->find('all',array('conditions'=>array(
												 	'UserFollowing.follow_user_id'=>$user_id
													),
													'limit'=>$limit
													));
		return $users_following;
	}
	
	/**
	 * Returns the total following count
	 * @param user_id The user to target
	 * @return total The total users the user is following
	 * 
	*/
	public function getFollowCount($user_id=null,$limit=10){
		$total = $this->find('count',array('conditions'=>array(
															'UserFollowing.user_id'=>$user_id
															),
															'limit'=>$limit
															));
		return $total;
	}
	
	/**
	 * Returns the total follower count
	 * @param user_id The user to target
	 * @return total The total followers of a user
	 * 
	*/
	public function getFollowerCount($user_id=null){
		$total = $this->find('count',array('conditions'=>array(
															'UserFollowing.follow_user_id'=>$user_id
															)));
		return $total;
	}
	
	/**
	 * Returns the ids of the users the logged in user is following
	 * @param int user_id The logged in user
	 * @return array user_id The people the logged in user is following
	 * 
	*/
	public function getFollowingUserIds($user_id=null){
		$this->recursive = -1;
		$user_ids = $this->find('list',array('conditions'=>array(
																'user_id'=>$user_id
																),
												'fields'=>array('follow_user_id')
												));
		return $user_ids;
	}
	
	/**
	 * Finds a limited number of user emails that are following the logged in user.
	 * @param 
	 * @return 
	 * 
	*/
	public function findUserFollowersEmails($user_id=null,$limit=5){
		$this->recursive = 1;
		$user_data = $this->find('all',array('conditions'=>array(
																'follow_user_id'=>$user_id
																),
												'fields'=>array('User.email'),
												'limit'=>$limit
												));
		//Find the emails
		$user_emails = array();
		for($i=0;$i<count($user_data);$i++){
			$user_emails[] = $user_data[$i]['User']['email'];
		}
		return $user_emails;
	}
}
