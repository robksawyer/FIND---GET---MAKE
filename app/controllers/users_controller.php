<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	/**
	 * Models.
	 *
	 * @access public
	 * @var array
	 */
	//var $uses = array('User','Forum.Topic','TwitterKit.TwitterKitUser');
	
	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	var $components = array('Email','Search.Prg','Uploader.Uploader');
	
	var $helpers = array('NumberToText');
	
	var $paginate = array(
		'User' => array(
			'limit' => 20,
			'order' => 'User.username ASC',
			'contain'=>false
		),
	);
	
	//This is for the search plugin
	var $presetVars = array(
							array('field' => 'name', 'type' => 'value'),
							array('field' => 'username', 'type' => 'value')
							);
	
	
	/**
	 * Before filter.
	 * 
	 * @access public
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allowedActions = array('ajax_more_user_feed_data','ajax_more_feed_data', 'forgot', 'listing', 'profile','getAvatar',
											'signup','login','logout','register','register_with_twitter','register_with_facebook',
											'twitter_logout','facebook_logout','staff_favorites',
											'facebook_signup','twitter_signup','check',
											'find','find_via_twitter','find_via_facebook',
											'ajax_find_users','ajax_find_facebook_users','ajax_find_twitter_users'
											);
		
		//$this->Auth->allow('login','logout','register','register_with_twitter','register_with_facebook','signup','forgot');
		
		$this->AjaxHandler->handle('ajax_hide_welcome','ajax_find_users');
	
		//Disable the Security component for certain actions
		/*if(isset($this->Security)){
			if($this->action == 'ajax_find_users' || $this->action == 'ajax_find_twitter_users' || $this->action == 'ajax_find_facebook_users'){
				$this->Security->enabled = false;
				$this->Security->validatePost = false;
				//$this->Security->blackHoleCallback = null;
			}
		}*/
		
		/*if (isset($this->params['admin'])) {
			$this->Toolbar->verifyAdmin();
			$this->layout = 'admin';
		}*/
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function beforeRender(){
		parent::beforeRender();
		
	}
	
	
	/**
	 * Add an email field to be saved along with creation.
	 * @param 
	 * @return 
	 * 
	*/
	/*function beforeFacebookSave(){
		$this->Connect->authUser['User']['email'] = $this->Connect->user('email');
		
		return true; //Must return true or will not save.
	}*/
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	/*function beforeFacebookLogin($user){
		//Logic to happen before a facebook login
	}*/
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	/*function afterFacebookLogin(){
		//Logic to happen after successful facebook login.
		$this->redirect('/signup');
	}*/
	
	/**************** AJAX METHODS ************************/
	
	/**
	 * Hides the welcome blurb that lives in the admin_moderate view
	 * @param 
	 * @return 
	 * 
	*/
	public function ajax_hide_welcome(){
		if($this->RequestHandler->isAjax()) {
			Configure::write('debug',0);
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('hide_welcome',1);
			$this->AjaxHandler->response(true, 1);
			$this->AjaxHandler->respond();
			return;
		}
	}
	
	/**
	 * Handles finding a user. This is triggered by the search box
	 * @param 
	 * @return 
	 * 
	*/
	public function ajax_find_users($offset=0){
		if($this->RequestHandler->isAjax()) {
			Configure::write('debug',0);
			/*$this->layout = 'ajax';
			$this->autoLayout = false;
			$this->autoRender = false;*/
			$response = array('success' => false);
			if(!empty($this->data)){
				$this->passedArgs['search'] = $this->data['User']['search'];
				$results = $this->User->find('all',array('conditions'=>array(
																			'OR' => array(
																				array('User.username LIKE'=>'%'.$this->passedArgs['search'].'%'),
																				array('User.fullname LIKE'=>'%'.$this->passedArgs['search'].'%')	
																			)
																			),
																			'limit'=>10,
																			'contain'=>array('Product'=>array('Attachment','limit'=>'3','order'=>'created DESC'))
																			));
																			

				$query = $this->passedArgs['search'];
				$this->set(compact('results','query')); //Set the results for the render action
				$this->render('/users/ajax_find_users');
				
				//$data['query'] = $this->passedArgs['search'];
				//$this->AjaxHandler->response(true, $data);
				//$this->AjaxHandler->respond();
				return true;
			}
		}
	}
	
	/**
	 * Returns the feed data based on the offset passed for the logged in user
	 * @param offset
	 * @return 
	 * 
	*/
	public function ajax_more_feed_data($offset=0){
		Configure::write ( 'debug', 0);
		$this->autoLayout = true;
		$this->autoRender = true;
		$user_id = $this->Auth->user('id');
		//$user = $this->User->read(null,$user['User']['id']);
		if(!empty($user_id)){
			//Find all of the followed users (with details) for this user
			$following_user_ids = $this->User->getFollowingUserIds($user_id);
			$feed = $this->User->Feed->getUsersFollowingFeedData($following_user_ids,$offset);
			$this->set(compact('feed'));
		}else{
			$feed = null;
			$this->set(compact('feed'));
		}
	}
	
	/**
	 * Returns the feed data for a user passed
	 * @param user_id
	 * @param offset
	 * @return 
	 * 
	*/
	public function ajax_more_user_feed_data($user_id=null,$offset=0){
		Configure::write ( 'debug', 0);
		$this->autoLayout = true;
		$this->autoRender = true;
		//$this->render('ajax_more_user_feed_data', 'ajax');
		if(!empty($user_id)){
			$feed = $this->User->Feed->getUserFeedDataDetails($user_id,$offset);
			$this->set(compact('feed'));
		}else{
			$feed = null;
			$this->set(compact('feed'));
		}
	}
	
	/**
	 * Find users by searching the user's facebook friends
	 * @param 
	 * @return 
	 * 
	*/
	public function ajax_find_facebook_users($access_token=null,$offset=0){
		if($this->RequestHandler->isAjax()) {
			Configure::write ( 'debug', 0);
			$this->autoLayout = true;
			$this->autoRender = true;
			//Check to see if facebookUser is available or if the user has their account linked. If they do, 
			//don't launch a popup and ask them to verify their results. Otherwise, launch a window and make the 
			//user link their account.
			$Facebook = new FB();
			if(!empty($access_token)){
				$Facebook->setAccessToken($access_token);
				$this->Session->write("FB.Token",$access_token);
			}else{
				//$access_token = $Facebook->getAccessToken();
				$access_token = $this->Session->read("FB.Token");
				$Facebook->setAccessToken($access_token);
			}
			$this->Connect->uid = $Facebook->getUser();
			$facebookUserDetails = $this->Connect->user();
			debug($facebookUserDetails);
			$facebookFriends = $Facebook->api("/me/friends");
			debug($facebookFriends);
			$friends = array();
			//Search the system for friends that contain a similar fullname
			if(!empty($facebookFriends['data'])){
				foreach($facebookFriends['data'] as $friend){
					$friends[] = $friend['name'];
				}
				foreach($facebookFriends['data'] as $friend){
					$friend_ids[] = $friend['id'];
				}
				debug($friend_ids);
				//Search the friends array
				$results = $this->User->find('all',array('conditions'=>array(
																			'OR'=>array(
																				array('User.fullname'=>$friends),
																				array('User.facebook_id'=>$friend_ids)
																			)
																			),
																			'limit'=>10,
																			'contain'=>array('Product'=>array('Attachment','limit'=>'3'))
																		));
			}else{
				$results = null;
			}
			
			//Get the facebook user's friends.
			$this->set(compact('results'));
			
		}
	}
	
	/**
	 * Find users by searching the user's facebook friends
	 * @param 
	 * @return 
	 * 
	*/
	public function ajax_find_twitter_users($offset=0){
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = true;
			$this->autoRender = true;
			//Controller::loadModel('TwitterKit.TwitterKitUser');
			Configure::write('debug',0);
			
			//https://api.twitter.com/1/friends/ids.json?cursor=-1&screen_name=twitterapi
			//On Error:
			/*Array
			(
			    [error] => This method requires authentication.
			    [request] => /1/friends/ids.json
			)
			*/
			//https://api.twitter.com/1/friends/ids.json?cursor=-1&screen_name=twitterapi
			//$token = $this->Session->read('Twitter.Token');
			//debug($token);
			//$this->Twitter->setTwitterSource('twitter');
			//$this->Twitter->setToken($token['oauth_token']);
			$userDetails = $this->Session->read('Twitter.Details');
			$twitter_friend_ids = $this->Twitter->friends_ids(array('id'=>$userDetails['id']));
			$twitter_friends = array();
			$limit = 25; //Set the limit to search
			$counter = 0;
			if(empty($twitter_friend_ids['error'])){
				foreach($twitter_friend_ids as $friend_id){
					if($counter >= $limit) break;
					$temp = $this->Twitter->users_lookup(array('user_id'=>$friend_id));
					if(!empty($temp)){
						$twitter_friends['ids'][] = $temp[0]['id'];
						$twitter_friends['names'][] = $temp[0]['name'];
						$twitter_friends['screen_names'][] = $temp[0]['screen_name'];
						$counter++;
					}
				}
				//debug($twitter_friends);
				$results = $this->User->find('all',array('conditions'=>array(
																			'OR'=>array(
																				array('User.username' => $twitter_friends['screen_names']),
																				array('User.fullname' => $twitter_friends['names']),
																				array('User.twitter_id' => $twitter_friend_ids)
																			)
																		)
																	));
			}else{
				$results['error'] = $twitter_friend_ids['error'];
			}
			$this->set(compact('results'));
			return;
		}
		
	}
	
	/**************** END AJAX METHODS ************************/
	
	/**************** BORROWED FROM CUPCAKE ************************/
	/**
	 * Redirect.
	 *
	 * @access public 
	 */
	public function index() {
		$this->Toolbar->goToPage();
	}
	
	/**
	 * Forgot credentials.
	 *
	 * @access public
	 */
	public function forgot() {
		$this->set('title_for_layout','Forgot Password');
		$this->layout = 'clean';
		
		if (!empty($this->data)) {
			if ($user = $this->User->forgotRetrieval($this->data)) {
				$this->Toolbar->resetPassword($user);
				
				$this->Session->setFlash(__('Your new password and information has been sent to your email.', true));
				unset($this->data['User']);
			}
		}
		
		//this->Toolbar->pageTitle(__('Forgot Password', true));
	}
	
	/**
	 * Login.
	 *
	 * @access public
	 */
	public function login() {
		$this->set('title_for_layout','Login');
		$this->layout = 'clean';
		$userCheck = $this->Auth->user();
		if(empty($this->data)){
			if(!empty($userCheck)){
				$this->Auth->login($userCheck);
				$this->Auth->autoRedirect = false;
				//$this->Session->delete('Forum');
				$this->redirect($this->Auth->loginRedirect);
			}
		}
		
		
		//Check for a Twitter user
		$twitterUserDetails = $this->Session->read('Twitter.Details');
		if(!empty($twitterUserDetails) && empty($this->data)){
			$userCheck = $this->User->findByTwitterId($twitterUserDetails['id']);
			if(empty($userCheck)){
				$this->redirect('/users/twitter_signup');
			}else{
				//Try to log the user in.
				$loginUser['User']['username'] = $userCheck['User']['username'];
				$loginUser['User']['password'] = $userCheck['User']['password'];
				
				$this->Auth->login($loginUser);
				$this->Session->delete('Forum');
				$this->redirect($this->Auth->loginRedirect);
			}
		}
		//Check for a Facebook user
		$facebookUser = $this->Connect->user();
		if(!empty($facebookUser) && empty($this->data)){
			$userCheck = $this->User->findByFacebookId($facebookUser['id']);
			if(empty($userCheck)){
				$this->redirect('/users/facebook_signup');
			}else{
				//Try to log the user in.
				$loginUser['User']['username'] = $userCheck['User']['username'];
				$loginUser['User']['password'] = $userCheck['User']['password'];
				
				$this->Auth->login($loginUser);
				$this->Session->delete('Forum');
				$this->redirect($this->Auth->loginRedirect);
				
				//Save the user's facebook_id (This is automatically handled)
				//$this->User->saveField('facebook_id',$facebookUser['id']);
			}
		}
		
		if (!empty($this->data)) {
			$this->User->set($this->data);
			$this->User->action = 'login';
			
			if ($this->User->validates()) {
				if ($user = $this->Auth->user()) {
					$this->User->login($user);
					$this->Session->delete('Forum');
					$this->redirect($this->Auth->loginRedirect);
				}
			}
		}
		
		//FACEBOOK OAUTH SETTINGS
		$Facebook = new FB();
		$loginURL = $Facebook->getLoginUrl(array('req_perms'=>'user_about_me,user_birthday,email,offline_access,publish_stream',
												'next'=>'/facebook_signup'
												)); //Get the login url to use
		
		//Set the Twitter authorize url
		$this->Twitter->setTwitterSource("twitter");
		$twitterAuthorizeURL = $this->Twitter->getAuthenticateUrl();
		$this->set(compact('twitterAuthorizeURL','loginURL'));
		
		//$this->Toolbar->pageTitle(__('Login', true));
	}
	
	/**
	 * Logout.
	 *
	 * @access public
	 */
	public function logout() {
		if($this->Session->check('Forum')) $this->Session->delete('Forum');
		if($this->Session->check('Twitter')) $this->Session->delete('Twitter');
		if($this->Session->check('Challenge')) $this->Session->delete('Challenge');
		if($this->Session->check('User')) $this->Session->delete('User');
		if($this->Session->check('Auth')) $this->Session->delete('Auth');
	
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
		exit;
	}
	
	/**
	 * List of all users.
	 *
	 * @access public
	 */
	public function listing() {
		if (!empty($this->data)) {
			if (!empty($this->data['User']['username'])) {
				$this->paginate['User']['conditions']['User.username LIKE'] = '%'. $this->data['User']['username'] .'%';
			}
		}
		
		$this->Toolbar->pageTitle(__('User List', true));
		$this->set('users', $this->paginate('User'));
	}
	
	/**
	 * User profile.
	 *
	 * @access public
	 * @param int $id
	 */
	public function profile($username=null) {
		//Check to see if the id was passed
		if(intval($username)>0){
			$id = intval($username);
			$user = $this->User->getProfile($id);
		}else{
			$userTemp = $this->User->find('first',array('conditions'=>array('username'=>$username)));
			$id = $userTemp['User']['id'];
			$user = $this->User->getProfile($id);
		}
		
		if (!empty($user)) {
			$this->loadModel('Forum.Topic');
			$this->set('topics', $this->Topic->getLatestByUser($id));
			$this->set('posts', $this->Topic->Post->getLatestByUser($id));
			
			//Check for a local avatar details
			if(!empty($user['User']['attachment_id'])){
				$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
			}else{
				$avatar = false;
			}
			$this->set('avatar',$avatar);
		}else{
			//Render the moderate action instead
			return $this->setAction('moderate');
		}
		
		$this->set('title_for_layout','Profile: '.$user['User']['username']);
		//$this->Toolbar->pageTitle(__('User Profile', true), $user['User']['username']);
		$this->set('user', $user);
	}
	
	/**
	 * Report a user.
	 *
	 * @access public
	 * @param int $id
	 */
	public function report($id) {
		$this->loadModel('Forum.Report');
		
		$user = $this->User->get($id, array('id', 'username'));
		$user_id = $this->Auth->user('id');
		
		// Access
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		// Submit Report
		if (!empty($this->data)) {
			$this->data['Report']['user_id'] = $user_id;
			$this->data['Report']['item_id'] = $id;
			$this->data['Report']['itemType'] = 'user';
			
			if ($this->Report->save($this->data, true, array('item_id', 'itemType', 'user_id', 'comment'))) {
				$this->Session->setFlash(__('You have succesfully reported this user! A moderator will review this topic and take the necessary action.', true));
				unset($this->data['Report']);
			}
		}
		
		$this->Toolbar->pageTitle(__('Report User', true));
		$this->set('id', $id);
		$this->set('user', $user);
	}
	
	/**
	 * Signup.
	 *
	 * @access public
	 */
	public function signup() {
		$this->set('title_for_layout','Sign Up');
		$this->layout = 'clean';
		$twitter_link = false; //Used to link an existing account
		$facebook_link = false; //Used to link an existing account
		
		//Check to make sure the user hasn't already linked their account with Twitter
		$twitterUserDetails = $this->Session->read('Twitter.Details');
		//debug($twitterUserDetails);
		if(!empty($twitterUserDetails)){
			$twitter_user = $this->User->findByTwitterId($twitterUserDetails['id']);
			if(!empty($twitter_user)) $twitter_link = true;
		}
		
		//Check to make sure the user hasn't already linked their account with Facebook
		$facebookUserDetails = $this->Connect->user();
		if(!empty($facebookUserDetails)){
			$facebook_user = $this->User->findByFacebookId($facebookUserDetails['id']);
			if(!empty($facebook_user)) $facebook_link = true;
		}
		
		//The user already has an account
		if($twitter_link == true){
			$user = $twitter_user;
		}else if($facebook_link == true){
			$user = $facebook_user;
		}
		
		//Log the user in with Twitter or Facebook the user data
		if(!empty($user) && empty($this->data)){
			//Build an array of information to login with
			$user_data['User'] = array(
				'username' => $user['User']['username'],
				'password' => $user['User']['password']
			);
			$this->Auth->login($user_data);
			
			//Redirect to moderate page
			$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'moderate'));
		}
		
		if (!empty($this->data)) {
			$this->User->create();
			$this->User->set($this->data);
			$this->User->action = 'signup';
			
			if ($this->User->validates()) {
				$this->data['User']['username'] = strip_tags($this->data['User']['username']);
				$this->data['User']['fullname'] = strip_tags($this->data['User']['fullname']);
				$this->data['User']['location'] = strip_tags($this->data['User']['location']);
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['newPassword']);
				$this->data['User'][$this->User->columnMap['locale']] = $this->Toolbar->settings['default_locale'];
				$this->data['User']['slug'] = $this->toSlug($this->data['User']['username']);
				
				if(empty($this->data['User']['twitter_id'])) $this->data['User']['twitter_id'] = 0;
				
				if ($this->User->save($this->data, false, array('username', 'email', 'location','fullname','twitter_id','password','slug', $this->User->columnMap['locale']))) {
					//$this->Session->setFlash(__('You have successfully signed up, you may now login and start your journey.', true));
					// Send email
					$this->sendSignupEmail();
					
					$this->Auth->login($this->data);
					unset($this->data['User']);
					$this->Session->setFlash(__('You have successfully created an account and may now start your journey.', true));
					$this->redirect(array('plugin'=>'','controller'=>'users','action'=>'moderate','admin'=>false));
					
					//$this->redirect(array('plugin'=>'','controller' => 'users', 'action' => 'login', 'admin' => false));
				}
			}
		}
		
		//$this->Toolbar->pageTitle(__('Sign Up', true));
	}
	
	/**
	 * Facebook Signup.
	 *
	 * @access public
	 */
	public function facebook_signup() {
		$this->set('title_for_layout','Sign Up');
		$this->layout = 'clean';
		$facebook_link = false; //Used to link an existing account
		
		//Check to make sure the user hasn't already linked their account with Facebook
		$facebookUserDetails = $this->Connect->user();
		if(!empty($facebookUserDetails)){
			$facebook_user = $this->User->findByFacebookId($facebookUserDetails['id']);
			$facebook_profile_url = 'https://graph.facebook.com/'.$facebookUserDetails['id'].'/picture?type=large';
			if(!empty($facebook_user)) $facebook_link = true;
		}else{
			$this->redirect('/login');
		}
		
		//The user already has an account
		if($facebook_link == true){
			$user = $facebook_user;
		}
		
		//Log the user in with Twitter or Facebook the user data
		if(!empty($user) && empty($this->data)){
			//Build an array of information to login with
			$user_data['User'] = array(
				'username' => $user['User']['username'],
				'password' => $user['User']['password']
			);
			$this->Auth->login($user_data);
			
			//Redirect to moderate page
			$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'moderate'));
		}
		
		if (!empty($this->data)) {
			$this->User->create();
			$this->User->set($this->data);
			$this->User->action = 'signup';
			
			//Check to see if the user exists
			$emailUserCheck = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data['User']['email'])));
			if(!empty($emailUserCheck)){
				//Make sure that the user's current password matches the entered password
				//The user already has an account. (Add the twitter_id to the account)
				$this->User->id = $emailUserCheck['User']['id'];
				//Check to see if the user has a profile image attached. If not, add the Twitter profile image.
				$check = array();
				//Set data that may not be there.
				if(empty($emailUserCheck['User']['location'])){
					$check[] = $this->User->saveField('location',$this->data['User']['location']);
				}	
				if(empty($emailUserCheck['User']['birthday'])){
					$check[] = $this->User->saveField('birthday',$this->data['User']['birthday']);
				}
				if(empty($emailUserCheck['User']['gender'])){
					$check[] = $this->User->saveField('gender',$this->data['User']['gender']);
				}
				if(empty($emailUserCheck['User']['attachment_id']) && empty($emailUserCheck['User']['profile_image_url'])){
					//Add the user's Twitter profile image
					$check[] = $this->User->saveField('profile_image_url',$facebook_profile_url);
				}
				
				$check[] = $this->User->saveField('facebook_id',$this->data['User']['facebook_id']);
				if(!empty($check)){
					//The user was updated and the account was linked
					//Log the user in.
					$this->Auth->login($this->User);
					//Redirect to moderate page
					$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'moderate'));
					exit;
				}else{
					//There was a problem saving the twitter_id
					$this->Session->setFlash(__('There was a problem linking your account. Please try again later.', true), 'default', 'error-message');
					exit;
				}
			}
			
			if ($this->User->validates()) {
				$this->User->recursive = -1;
				//The user doesn't have an account, create one.
				$this->data['User']['username'] = strip_tags($this->data['User']['username']);
				$this->data['User']['fullname'] = strip_tags($this->data['User']['fullname']);
				$this->data['User']['location'] = strip_tags($this->data['User']['location']);
				$this->data['User']['birthday'] = strip_tags($this->data['User']['birthday']);
				$this->data['User']['gender'] = strip_tags($this->data['User']['gender']);
				
				//$this->data['User']['about'] = $facebookUserDetails['description'];
				$this->data['User']['profile_image_url'] = $facebook_profile_url; //Add the user's profile image
				
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['newPassword']);
				$this->data['User'][$this->User->columnMap['locale']] = $this->Toolbar->settings['default_locale'];
				$this->data['User']['slug'] = $this->toSlug($this->data['User']['username']);

				if ($this->User->save($this->data, false, array('username', 'email', 'gender','location','fullname','facebook_id','birthday','password','slug', $this->User->columnMap['locale']))) {
					//$this->Session->setFlash(__('You have successfully signed up, you may now login and start your journey.', true));
					// Send email
					$this->sendSignupEmail();

					$this->Auth->login($this->data);
					unset($this->data['User']);
					$this->Session->setFlash(__('You have successfully created an account and may now start your journey.', true));
					$this->redirect(array('plugin'=>'','controller'=>'users','action'=>'moderate','admin'=>false));

					//$this->redirect(array('plugin'=>'','controller' => 'users', 'action' => 'login', 'admin' => false));
				}
			}
		}
		
		//Add the data to the fields
		if(!empty($facebookUserDetails) && empty($this->data)){
			//Load the data array with Twitter data
			$this->data['User']['fullname'] = $facebookUserDetails['name'];
			$this->data['User']['username'] = $facebookUserDetails['username'];
			$this->data['User']['location'] = $facebookUserDetails['location']['name']; //Get the location
			$this->data['User']['facebook_id'] = $facebookUserDetails['id'];
			$this->data['User']['email'] = $facebookUserDetails['email'];
			$this->data['User']['birthday'] = $facebookUserDetails['birthday'];
			$this->data['User']['gender'] = strtoupper($facebookUserDetails['gender'][0]);
			
		}
		
		//$this->Toolbar->pageTitle(__('Sign Up', true));
	}
	
	/**
	 * Twitter Signup.
	 *
	 * @access public
	 */
	public function twitter_signup() {
		$this->set('title_for_layout','Sign Up');
		$this->layout = 'clean';
		$twitter_link = false; //Used to link an existing account
	
		//Check to make sure the user hasn't already linked their account with Twitter
		$twitterUserDetails = $this->Session->read('Twitter.Details');
		//debug($twitterUserDetails);
		if(!empty($twitterUserDetails)){
			$twitter_user = $this->User->findByTwitterId($twitterUserDetails['id']);
			if(!empty($twitter_user)) $twitter_link = true;
		}else{
			$this->redirect('/login');
		}
		
		//The user already has an account
		if($twitter_link == true){
			$user = $twitter_user;
		}
		
		//Log the user in with Twitter or Facebook the user data
		if(!empty($user) && empty($this->data)){
			//Build an array of information to login with
			$user_data['User'] = array(
				'username' => $user['User']['username'],
				'password' => $user['User']['password']
			);
			$this->Auth->login($user_data);
			
			//Redirect to moderate page
			$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'moderate'));
		}
		
		if (!empty($this->data)) {
			$this->User->create();
			$this->User->set($this->data);
			$this->User->action = 'signup';
			
			//Check to see if the user's email matches another user in the system. If it does, add the new information to that user's account.
			$emailUserCheck = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data['User']['email'])));
			if(!empty($emailUserCheck)){
				//The user already has an account. (Add the twitter_id to the account)
				$this->User->id = $emailUserCheck['User']['id'];
				//Check to see if the user has a profile image attached. If not, add the Twitter profile image.
				$check = array();
				if(empty($emailUserCheck['User']['attachment_id']) && empty($emailUserCheck['User']['profile_image_url'])){
					//Add the user's Twitter profile image
					$check[] = $this->User->saveField('profile_image_url',$twitterUserDetails['profile_image_url']);
				}	
				$check[] = $this->User->saveField('twitter_id',$twitterUserDetails['id']);
				if(!empty($check)){
					//The user was updated and the account was linked
					//Log the user in.
					$this->Auth->login($this->User);
					//Redirect to moderate page
					$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'moderate'));
					exit;
				}else{
					//There was a problem saving the twitter_id
					$this->Session->setFlash(__('There was a problem linking your account. Please try again later.', true), 'default', 'error-message');
					exit;
				}
			}
			
			if ($this->User->validates()) {
				$this->User->recursive = -1;
				//The user doesn't have an account, create one.
				$this->data['User']['username'] = strip_tags($this->data['User']['username']);
				$this->data['User']['fullname'] = strip_tags($this->data['User']['fullname']);
				$this->data['User']['location'] = strip_tags($this->data['User']['location']);
				$this->data['User']['about'] = $twitterUserDetails['description'];
				$this->data['User']['profile_image_url'] = $twitterUserDetails['profile_image_url']; //Add the user's profile image
				
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['newPassword']);
				$this->data['User'][$this->User->columnMap['locale']] = $this->Toolbar->settings['default_locale'];
				$this->data['User']['slug'] = $this->toSlug($this->data['User']['username']);

				if ($this->User->save($this->data, false, array('username', 'email', 'location','fullname','twitter_id','password','slug', $this->User->columnMap['locale']))) {
					//$this->Session->setFlash(__('You have successfully signed up, you may now login and start your journey.', true));
					// Send email
					$this->sendSignupEmail();

					$this->Auth->login($this->data);
					unset($this->data['User']);
					$this->Session->setFlash(__('You have successfully created an account and may now start your journey.', true));
					$this->redirect(array('plugin'=>'','controller'=>'users','action'=>'moderate','admin'=>false));

					//$this->redirect(array('plugin'=>'','controller' => 'users', 'action' => 'login', 'admin' => false));
				}
			}
		}
		
		//Be sure to add the data after the empty check
		//The user doesn't have an account
		if(!empty($twitterUserDetails) && empty($this->data)){
			//Load the data array with Twitter data
			$this->data['User']['fullname'] = $twitterUserDetails['name'];
			$this->data['User']['username'] = $twitterUserDetails['screen_name'];
			$this->data['User']['location'] = $twitterUserDetails['location'];
			$this->data['User']['twitter_id'] = $twitterUserDetails['id'];
		}
		
		//$this->Toolbar->pageTitle(__('Sign Up', true));
	}
	
	/**
	 * Sends the user an email after they signup.
	 * @param 
	 * @return 
	 * 
	*/
	protected function sendSignupEmail(){
		$message  = sprintf(__('Thank you for signing up on %s, your information is listed below', true), $this->Toolbar->settings['site_name']) .":\n\n";
		$message .= __('Username', true) .": ". $this->data['User']['username'] ."\n";
		$message .= __('Password', true) .": ". $this->data['User']['newPassword'] ."\n\n";
		$message .= __('Enjoy!', true);
		
		$this->Email->to = $this->data['User']['email'];
		$this->Email->from = $this->Toolbar->settings['site_name'] .' <'. $this->Toolbar->settings['site_email'] .'>';
		$this->Email->subject = $this->Toolbar->settings['site_name'] .' - '. __('Sign Up Confirmation', true);
		$this->Email->send($message);
	}
	
	/**
	 * Admin index!
	 *
	 * @access public
	 * @category Admin
	 */
	public function admin_index() {
		if (!empty($this->data)) {
			if (!empty($this->data['User']['username'])) {
				$this->paginate['User']['conditions']['User.username LIKE'] = '%'. $this->data['User']['username'] .'%';
			}
			
			if (!empty($this->data['User']['id'])) {
				$this->paginate['User']['conditions']['User.id'] = $this->data['User']['id'];
			}
		}

		$this->pageTitle = __('Manage Users', true);
		$this->set('users', $this->paginate('User'));
	}
	
	/**
	 * Edit a user.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function admin_edit($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $id;
			
			if ($this->User->save($this->data, true, array('username', 'email', $this->User->columnMap['totalPosts'], $this->User->columnMap['totalTopics']))) {
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->data = $user;
		}
		
		$this->pageTitle = __('Edit User', true);
		$this->set('id', $id);
	}
	
	/**
	 * Reset users password.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function reset($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		if (!empty($user)) {
			$this->Toolbar->resetPassword($user, true);
			$this->Session->setFlash(sprintf(__('The password for %s has been reset!', true), '<strong>'. $user['User']['username'] .'</strong>'));
		}
		
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => false));
	}
	
	/**
	 * Delets a user and all its content.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function admin_delete($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		// Form Processing
		if (!empty($this->data['User']['delete'])) {
			$this->User->delete($id, true);

			$this->Session->setFlash(sprintf(__('The user %s and all of their associations have been deleted!', true), '<strong>'. $user['User']['username'] .'</strong>'));
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}
		
		$this->pageTitle = __('Delete User', true);
		$this->set('id', $id);
		$this->set('user', $user);
	}
	/**************** END BORROWED FROM CUPCAKE ************************/
	
	/**
	 * Handles registering the user with social services (Twitter, Facebook)
	 * @param 
	 * @return 
	 * 
	*/
	public function register(){
		$this->layout = 'clean';
		$this->set("title_for_layout","Register");
		
		//TWITTER OAUTH SETTINGS
		$linkOptions = array();
		if (!empty($this->params['named']['datasource'])) {
			$linkOptions['datasource'] = $this->params['named']['datasource'];
		}
		if (!empty($this->params['named']['authenticate'])) {
			$linkOptions['authenticate'] = $this->params['named']['authenticate'];
		}
		
        $this->set('linkOptions', $linkOptions);
	}
	
	/**
	 * Handles registering a user with the OAuth callback from Twitter. 
	 * @param 
	 * @return 
	 * 
	*/
	public function register_with_twitter() {
		Configure::write('debug',2);
		Controller::loadModel('TwitterKit.TwitterKitUser');
		$this->layout = 'social-popup';
		// check params
		if (empty($this->params['url']['oauth_token']) || empty($this->params['url']['oauth_verifier'])) {
			$this->Session->setFlash(__('Invalid access.', true), ' / ', 5);
			return;
		}
		
		// get token
		$this->Twitter->setTwitterSource('twitter');
		$token = $this->Twitter->getAccessToken();
		//debug($token);
		//debug($this->Twitter->getAnywhereIdentity());
		if (is_string($token)) {
			$this->Session->setFlash(__('Failed to get the access token.', true) . $token, ' / ', 5);
			return;
		}
		
		//create save data
		$data['User'] = array(
			'id' => $token['user_id'],
			'username' => $token['screen_name'],
			'password' => Security::hash($token['oauth_token']),
			'oauth_token' => $token['oauth_token'],
			'oauth_token_secret' => $token['oauth_token_secret'] //Access token
		);
		//Check to make sure the token is legit
		if(!empty($token['screen_name']) && !empty($token['user_id'])){
			//Find out if the user's email address is already in the system
			$userDetails = $this->Twitter->account_verify_credentials();
			//debug($userDetails);
			//Save the session data so that we can use it in the sign up form.
			$this->Session->write('Twitter.Details',$userDetails);
			$this->Session->write('Twitter.Token',$token);
			
			//Redirect to the signup page (This is handled by the popup unload method.)
			//$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'twitter_signup'));
		}else{
			$this->Session->setFlash(__('The Twitter authorization failed. Please try again later.', true), 'default', 'error-message');
			return;
		}
	}
	
	/**
	 * Handles registering a user with the OAuth callback from Twitter. 
	 * @param 
	 * @return 
	 * 
	*/
	public function register_with_facebook() {
		
	}
	
	/**
	 * Log out a Twitter user
	 * @param 
	 * @return 
	 * 
	*/
	public function twitter_logout(){
		$this->Twitter->deleteAuthorizeCookie();
	}
	
	/**
	 * Removes the Facebook auth cookie
	 * @param 
	 * @return 
	 * 
	*/
	public function facebook_logout(){
		$Facebook = new FB();
		//debug($Facebook->api('/me'));
		$absURL = Router::url("/logout", true);
		$logoutURL = $Facebook->getLogoutUrl(array('next'=>$absURL));
		if($this->Session->check('FB.Me')){
			$this->Session->delete('FB.Me');
			$this->Session->delete('FB');
		}
		if(!empty($this->facebookUser)){
			$this->facebookUser = null;
		}
		$this->redirect($logoutURL);
		//Deauthorize the facebook account
	}
	
	/**
	 *  User moderation panel
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function moderate() {
		$this->User->recursive = 1;
		$user = $this->Auth->user();

		if (!$user['User']['id']) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$user = $this->User->getProfile($user['User']['id']);

		if (!empty($user)) {
			//$this->loadModel('Forum.Topic');
			Controller::loadModel('Topic');
			$this->set('topics', $this->Topic->getLatestByUser($user['User']['id']));
			$this->set('posts', $this->Topic->Post->getLatestByUser($user['User']['id']));
		}
		
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		$this->set('avatar',$avatar);
		
		//$user = $this->User->read(null,$user['User']['id']);
		$this->User->UserFollowing->recursive = 1;
		$followers = $this->User->UserFollowing->findFollowers($user['User']['id'],5);
		$this->User->Ownership->recursive = 1;
		$user_wants = $this->User->Ownership->getUserWantCount('Product',$user['User']['id']);
		$user_haves = $this->User->Ownership->getUserHaveCount('Product',$user['User']['id']);
		$this->set(compact('user_wants','user_haves','followers'));
		//$this->set('user', $this->User->read(null, $user['User']['id']));
		$this->set('user', $user);
		
	}
	
	/**
	 * Handles showing staff favorites and allows users to find others
	 * @param 
	 * @return 
	 * 
	*/
	public function find(){
		Configure::write('debug',2);
		//Do a check to see if the user's account is linked
		$access_token = $this->Session->read('FB.Token');
		$Facebook = new FB();
		if(empty($access_token)){
			$access_token = $Facebook->getAccessToken();
			$token_check = explode("|",$access_token);
			if(count($token_check) > 1){
				//Delete the Facebook session
				$this->Session->delete('FB');
				//The token is not valid
				$facebookUser = null;
				$this->set(compact('facebookUser'));
			}
		}else{
			$Facebook->setAccessToken($access_token);
		}
		
		/*$favorites = $this->requestAction('/staff_favorites/getTenUsers');
		if(!empty($favorites)){
			$user_ids = array();
			foreach($favorites as $favorite_user){
				$user_ids[] = $favorite_user['User']['id']; 
			}

			$user_ids_string = implode('&',$user_ids);
			//Check to see if the user is following all of the users in the list
			$usersNotFollowing = $this->requestAction('/user_followings/isFollowingAll/'.$user_ids_string);

			//If the user isn't following all of the users listed, show the follow all button.
			if(!empty($usersNotFollowing)){
				echo $this->element('follow-all-button',array('cache'=>false,'user_ids'=>$user_ids)); 
			}
		}else{
			//none found
		}*/
	}
	
	
	/**
	 * Handles finding a user's Twitter friends that are also users of the site
	 * @param 
	 * @return 
	 * 
	*/
	public function find_via_twitter(){
		//1. Handle authenticating the user if they don't already have their account linked.
		//2. Scan the user's Twitter friends (the user's they are following)
		//3. Check to see if any of the usernames match any of the user's in our system. Maybe check by twitter id vs. User.twitter_id
	}
	
	/**
	 * Handles finding a user's Facebook friends that are also users of the site
	 * @param 
	 * @return 
	 * 
	*/
	public function find_via_facebook(){
		//1. Handle authenticating the user if they don't already have their account linked.
		//2. Scan the user's Facebook friends (the user's they are following)
		//3. Check to see if any of the usernames match any of the user's in our system. Maybe check by facebook id vs. User.facebook_id
	}

	
	/**
	 * Returns the avatar details, if there is one.
	 * @param 
	 * @return 
	 * 
	*/
	public function getAvatar($user_id=null){
		if(!$user_id){
			return false;
		}
		$user = $this->User->read(null,$user_id);
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		if(!empty($this->params['requested'])) {
			return $avatar;
		} else {
			$this->set(compact('avatar'));
		}
	}
	
	/**
	 * Finds the current staff favorites
	 * @param 
	 * @return Array An array of the users liked by the staff.
	 * 
	*/
	public function staff_favorites(){
		return $this->User->getStaffFavorites();
	}	

}