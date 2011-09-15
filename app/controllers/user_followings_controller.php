<?php
class UserFollowingsController extends AppController {

	var $name = 'UserFollowings';
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('following','followers','isFollowing','isFollowingAll');
											
		$this->AjaxHandler->handle('ajax_followUserID','ajax_unfollowUserID','ajax_follow_all','ajax_unfollow_all');
		
		/*if(isset($this->Security)){
			if($this->action == 'ajax_followUserID' || $this->action == 'ajax_unfollowUserID'){
				$this->Security->enabled = false;
				$this->Security->validatePost = false;
				//$this->Security->blackHoleCallback = null;
			}
		}*/
	}
	
	/**************** AJAX METHODS ************************/
	
	 /**
	 * Handles following a bulk of users
	 * @param String user_ids
	 * @return 
	 * 
	*/
	public function ajax_follow_all(){
		$this->UserFollowing->recursive = -1;
		Configure::write('debug', 2);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			
			//Get the user logged in
			$user = $this->Auth->user();
			if(!$user){
				$this->Session->setFlash(__('You have to login before you can follow users.', true));
				$this->redirect(array('ajax'=>false,'plugin'=>'','controller'=>'users','action' => 'login'));
			}
			//debug($this->data);
			$unfollowed_users = $this->data['unfollowed_user_ids'];
			$unfollowed_users = explode("&",$unfollowed_users); //Convert back to array
			if(!empty($unfollowed_users)){
				$counter = 0;
				$saveData = array();
				foreach($unfollowed_users as $follow_user){
					$saveData['UserFollowing'][$counter] = array();
					$saveData['UserFollowing'][$counter]['user_id'] = $user['User']['id'];
					$saveData['UserFollowing'][$counter]['follow_user_id'] = $follow_user;
					$counter++;
				}
				if($this->UserFollowing->saveAll($saveData['UserFollowing'])){
					//The save was successful
					$data = array('following'=>1,'user_id'=>$user['User']['id']);
					$this->AjaxHandler->response(true, $data);
				}
			}
		
			$this->AjaxHandler->respond();
			return;
		}
	}
	
	 /**
	 * Handles following a bulk of users
	 * @param String user_ids
	 * @return 
	 * 
	*/
	public function ajax_unfollow_all(){
		$this->UserFollowing->recursive = -1;
		Configure::write('debug', 2);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			
			//Get the user logged in
			$user = $this->Auth->user();
			if(!$user){
				$this->Session->setFlash(__('You have to login before you can follow users.', true));
				$this->redirect(array('ajax'=>false,'plugin'=>'','controller'=>'users','action' => 'login'));
			}
			
			$followed_users = $this->data['followed_user_ids'];
			$followed_users = explode("&",$followed_users); //Convert back to array
			if(!empty($followed_users)){
				$user_following_ids = $this->UserFollowing->find('list',array('conditions'=>array(
																							"UserFollowing.user_id"=>$user['User']['id'],
																							"AND"=>array(
																									'UserFollowing.follow_user_id'=>$followed_users
																								)
																							),
																			'fields'=>'UserFollowing.id'
																		)
																);
				$user_following_ids = array_values($user_following_ids);
				$conditions = array('UserFollowing.id'=>$user_following_ids);
				if($this->UserFollowing->deleteAll($conditions)){
					//The save was successful
					$data = array('following'=>0,'user_id'=>$user['User']['id']);
					$this->AjaxHandler->response(true, $data);
				}
			}
			$this->AjaxHandler->respond();
			return;
		}
	}
	
	/**
	 * This method handles following a user
	 * @param user_id The user_id being followed
	 * @return 
	 * 
	*/
	public function ajax_followUserID($user_id=null){
		$this->UserFollowing->recursive = -1;
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			
			//Get the user logged in
			$user = $this->Auth->user();
			if(!$user){
				$this->Session->setFlash(__('You have to login before you can follow users.', true));
				$this->redirect(array('plugin'=>'','controller'=>'users','action' => 'login'));
			}
			
			if($user['User']['id'] != $user_id){
				//Check to see if the record already exists
				$followRecord = $this->UserFollowing->find('first',array('conditions'=>array('UserFollowing.follow_user_id'=>$user_id,'UserFollowing.user_id'=>$user['User']['id'])));
				if(empty($followRecord)){
					$this->UserFollowing->create();
					$this->UserFollowing->set('user_id',$user['User']['id']);
					$this->UserFollowing->set('follow_user_id',$user_id);
					if($this->UserFollowing->save()){
						//The save was successful
						$data = array('following'=>1,'item_id'=>$user_id);
						$this->AjaxHandler->response(true, $data);
					}
				}else{
					$this->ajax_unfollowUserID($user_id);
				}
			}else{
				//The user shouldn't even see the follow button
				$data = array('following'=>0,'item_id'=>$user_id);
				$this->AjaxHandler->response(false, $data);
			}
			
			$this->AjaxHandler->respond();
			
			//Update the user's total followings
			$this->UserFollowing->User->updateTotalFollowCount($user['User']['id']);
			
			//Update the other user's total followers
			$this->UserFollowing->User->updateTotalFollowerCount($user_id);

			return;
		}
	}
	
	/**
	 * Unfollows a user
	 * @param user_id The user to unfollow
	 * @return 
	 * 
	*/
	public function ajax_unfollowUserID($user_id=null){
		$this->UserFollowing->recursive = -1;
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			
			//Get the user logged in
			$user = $this->Auth->user();
			if(!$user){
				$this->Session->setFlash(__('You have to login before you can unfollow users.', true));
				$this->redirect(array('plugin'=>'','controller'=>'users','action' => 'login'));
			}
			
			//Unfollow the user
			if($user['User']['id'] != $user_id){
				//double check to make sure the user is following
				$userFollowID = $this->UserFollowing->find('first',array('conditions'=>array('user_id'=>$user['User']['id'],'follow_user_id'=>$user_id)));
				if($userFollowID){
					$this->UserFollowing->delete($userFollowID['UserFollowing']['id']);
					//The auth user has successfully unfollowed the user
					$data = array('following'=>0,'item_id'=>$user_id);
					$this->AjaxHandler->response(true, $data);
				}else{
					//The user shouldn't even see the follow button
					$data = array('following'=>1,'item_id'=>$user_id);
					$this->AjaxHandler->response(false, $data);
				}
			}else{
				//The user shouldn't even see the follow button
				$this->AjaxHandler->response(false, 0);
			}
			
			$this->AjaxHandler->respond();
			
			//Update the user's total followings
			$this->UserFollowing->User->updateTotalFollowCount($user['User']['id']);
			
			//Update the other user's total followers
			$this->UserFollowing->User->updateTotalFollowerCount($user_id);

			return;
		}
	}
	/**************** END AJAX METHODS ************************/
	
	/**
	 * Finds the followers of the user id passed.
	 * @param string username The user id to check followers of
	 * @return 
	 * 
	*/
	public function following($username=null){
		$this->UserFollowing->recursive = -1;
		if (!$username) {
			$this->Session->setFlash(__('This is an invalid username.', true));
			$this->redirect('/');
		}
		$this->UserFollowing->User->recursive = 1;
		$user = $this->UserFollowing->User->findByUsername($username);
		$following = array();
		if(!empty($user)){
			//Find all of the users the logged in user is following (with details)
			$following = $this->UserFollowing->findFollowing($user['User']['id']);
			$this->set(compact('following','user'));
		}else{
			$this->Session->setFlash(__('This is an invalid username.', true));
			$this->redirect('/');
		}
	}
	
	/**
	 * Finds the followers of the user id passed.
	 * @param string username The user id to check followers of
	 * @return 
	 * 
	*/
	public function followers($username=null){
		$this->UserFollowing->recursive = -1;
		if (!$username) {
			$this->Session->setFlash(__('This is an invalid username.', true));
			$this->redirect('/');
		}
		$user = $this->UserFollowing->User->findByUsername($username);
		$followers = array();
		if(!empty($user)){
			$followers = $this->UserFollowing->findFollowers($user['User']['id']);
			//debug($followers);
			//Find all of the followed users (with details) for this user
			/*foreach($users_following as $follower){
				$followers[] = $this->UserFollowing->User->getFollowerDetails($follower['UserFollowing']['user_id']);
			}*/
			//debug($followerDetails);
			$this->set(compact('followers','user'));
		}else{
			$this->Session->setFlash(__('This is an invalid username.', true));
			$this->redirect('/');
		}
	}
	
	/**
	 * Checks to see if the logged in user is currently following the user passed.
	 * @param user_id The user id of the person to be followed
	 * @return 
	 * 
	*/
	public function isFollowing($user_id=null){
		$auth_user_id = $this->Auth->user('id');
		return $this->UserFollowing->isFollowing($auth_user_id,$user_id);
	}
	
	/**
	 * Checks to see if the logged in user is currently following the user passed.
	 * @param String user_ids 
	 * @return
	 * 
	*/
	public function isFollowingAll($user_ids=null){
		$auth_user_id = $this->Auth->user('id');
		$user_ids = explode("&",$user_ids); //Build an array from the string
		return $this->UserFollowing->isFollowingAll($auth_user_id,$user_ids);
	}

}