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
	public function findFollowing($user_id=null){
		$followers = $this->find('all',array('conditions'=>array(
													'UserFollowing.user_id'=>$user_id
													)));
		return $followers;
	}
	
	/**
	 * Find the users following the passed user
	 * @param int user_id
	 * @return array users_following The users following the user
	 * 
	*/
	public function findFollowers($user_id=null){
		$users_following = $this->find('all',array('conditions'=>array(
												 	'UserFollowing.follow_user_id'=>$user_id
													)));
		return $users_following;
	}
	
	/**
	 * Returns the total following count
	 * @param user_id The user to target
	 * @return total The total users the user is following
	 * 
	*/
	public function getFollowCount($user_id=null){
		$total = $this->find('count',array('conditions'=>array(
															'UserFollowing.user_id'=>$user_id
															)));
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
}
