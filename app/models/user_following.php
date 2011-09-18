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
	
	var $hasMany = array(
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'UserFollowing'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	/**
	 * Adds feed data 
	 * @param created 
	 * @return 
	 * 
	*/	
	public function afterSave($created){
		$this->recursive = 1;
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['UserFollowing']['user_id'])){
				$this->User->updateTotalFollowerCount($last['UserFollowing']['user_id']);
				
				//Add the feed data to the feed
				$this->Feed->addFeedData('UserFollowing',$last);
			}
		}
	}
	
	/**
	 * Find the users that a certain user is following
	 * @param 
	 * @return 
	 * 
	*/
	public function findFollowing($user_id=null,$limit=10){
		$users_following = $this->find('list',array('conditions'=>array(
													'UserFollowing.user_id'=>$user_id
													),
													'fields'=>array('UserFollowing.follow_user_id'),
													'limit'=>$limit
													));
		$users_following = array_values($users_following);
		
		$following = $this->User->find('all',array('conditions'=>array(
													'User.id'=>$users_following
													),
													'contain'=>array('Attachment'=>array(
																		'conditions'=>array('Attachment.id'=>'User.attachment_id'),
																		'fields'=>array('Attachment.id','Attachment.path_med','Attachment.path_small')
																		)
																	),
													'limit'=>$limit
													));
		return $following;
	}
	
	/**
	 * Find the users following the passed user
	 * @param int user_id
	 * @return array users_following The users following the user
	 * 
	*/
	public function findFollowers($user_id=null,$limit=10){
		$followers = $this->find('all',array('conditions'=>array(
												 	'UserFollowing.follow_user_id'=>$user_id
													),
													'contain'=>array('User',
																	'User.Attachment'=>array(
																		'conditions'=>array('Attachment.id'=>'User.attachment_id'),
																		'fields'=>array('Attachment.id','Attachment.path_med','Attachment.path_small')
																		)
																	),
													'limit'=>$limit
													));
		return $followers;
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
	
	/**
	 * Checks a single user id against the auth user to see if the auth user is following the user
	 * @param 
	 * @return 
	 * 
	*/
	public function isFollowing($auth_user_id=null,$user_id=null){
		$user_count = $this->find('count',array('conditions'=>array(
																'UserFollowing.user_id'=>$auth_user_id,
																'UserFollowing.follow_user_id'=>$user_id
																)
															));
		return $user_count;
	}
	
	/**
	 * Checks a list of user ids
	 * @param 
	 * @return
	 * 
	*/
	public function isFollowingAll($auth_user_id=null,$user_ids=null){
		$user_count = $this->find('count',array('conditions'=>array(
																'UserFollowing.user_id'=>$auth_user_id,
																'UserFollowing.follow_user_id'=>$user_ids
																)
															));
		return $user_count;
	}
	
	/**
	 * Handles following a bulk of users at one time.
	 * @param 
	 * @return 
	 * 
	*/
	public function followAll($auth_user_id=null,$user_ids=null){
		//if($this->save)
	}
	
	/**
	 * Handles setting up an array that contains the current followed and unfollowed users of the auth user.
	 * @param int user_id The user id to pull results from 
	 * @param Array unfollowed_user_compare_ids The ids to check against
	 * @return Array user_ids The user ids that the auth user is following/not following
	 * 
	*/
	public function getFollowedUnfollowedUserIds($user_id=null,$unfollowed_user_compare_ids=null){
		$follower_ids = $this->User->find('all',array('conditions'=>array(
														'User.id'=>$user_id
														),
												'fields'=>array('User.username'),
												'contain'=>array('UserFollowing'=>array('fields'=>'UserFollowing.follow_user_id'))
										));
		$follower_ids = Set::extract('/UserFollowing/follow_user_id', $follower_ids); //Extract only the friends (followed users)
		$followed_user_ids = array();
		//Return the results that the user isn't following
		foreach($follower_ids as $follower_id){
			//Make sure to not add the auth user's id
			if($user_id != $follower_id){
				$followed_user_ids[] = $follower_id;	
			}
		}
		$unfollowed_user_ids = array_diff($unfollowed_user_compare_ids,$follower_ids);
		//Remove the auth user from the array if this user exists
		$auth_user_key = array_search($user_id,$unfollowed_user_ids);
		if(isset($auth_user_key)) unset($unfollowed_user_ids[$auth_user_key]);
		$unfollowed_user_ids = array_values($unfollowed_user_ids); //Reset the array keys
		$user_ids = array();
		//You have to send the items as a string, otherwise it'll fail to send the ajax request
		$user_ids['unfollowed_user_ids'] = implode('&',$unfollowed_user_ids);
		$user_ids['followed_user_ids'] = implode('&',$followed_user_ids);
		return $user_ids;
	}
	
	/**
	 * Returns the similar users between two users. 
	 * This can be used to give the followed user a better idea of why someone followed them.
	 * @param Int followed_user_id The person being followed
	 * @param Int auth_user_id The person  doing the following
	 * @return The similar followers between the two users
	 * 
	*/
	public function getSimilarFollowers($followed_user_id=null,$auth_user_id=null){
		$auth_user_followers = $this->find('all',array('conditions'=>array(
																'UserFollowing.user_id'=>$auth_user_id
																),
												'fields'=>array('UserFollowing.follow_user_id'),
												'contain'=>array('User')
												));
		$auth_user_followers = Set::extract('/UserFollowing/follow_user_id', $auth_user_followers); //Extract only the friends (followed users)
		$followed_user_followers = $this->find('all',array('conditions'=>array(
																'UserFollowing.user_id'=>$followed_user_id
																),
												'fields'=>array('UserFollowing.follow_user_id'),
												'contain'=>array('User')
												));
		$followed_user_followers = Set::extract('/UserFollowing/follow_user_id', $followed_user_followers); //Extract only the friends (followed users)
		
		$similar_user_ids = array_intersect($followed_user_followers,$auth_user_followers);
		
		if(!empty($similar_user_ids)){
			$similar_users = $this->User->find('all',array('conditions'=>array(
																	'User.id'=>$similar_user_ids
																	),
															'limit'=>15
															));
			//Add the profile image if it exists
			if(!empty($similar_users)){
				for($i=0;$i<count($similar_users);$i++){
					if(!empty($similar_users[$i]['User']['attachment_id'])){
						$similar_users[$i][] = $this->User->Attachment->find('first',array('conditions'=>array(
																				'Attachment.id'=>$similar_users[$i]['User']['attachment_id']
																				)
																			));
					}
				}
			}
			
		}else{
			$similar_users = null;
		}
		
		//If the user has an attachment id, add this to the final results
		return $similar_users;
	}
	
	/**
	 * Returns the needed feed data for a specific record
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function getFeedData($model_id=null){
		$this->recursive = 1;
		$this->User->recursive = -1;
		$data = $this->read(null,$model_id);	
		
		return $data;
	}
}