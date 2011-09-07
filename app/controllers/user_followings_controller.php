<?php
class UserFollowingsController extends AppController {

	var $name = 'UserFollowings';
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('following','followers','isFollowing');
											
		$this->AjaxHandler->handle('ajax_followUserID','ajax_unfollowUserID');
	}
	
	/**************** AJAX METHODS ************************/
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
}